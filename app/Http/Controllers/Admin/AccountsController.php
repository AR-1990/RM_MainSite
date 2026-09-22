<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseLog;
use App\Models\SalaryPayment;
use App\Models\SalaryPaymentLog;
use App\Models\SalaryPaymentNote;
use App\Models\SalaryAdvance;
use App\Models\SalaryAdvanceInstallment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountsController extends Controller
{
    public function dashboard()
    {
        $monthlyExpense = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        $monthlySalaries = SalaryPayment::where('month', now()->format('Y-m'))
            ->sum('net_salary');

        $categories = ExpenseCategory::orderBy('name')->get();

        return view('admin.accounts.dashboard', compact('monthlyExpense', 'monthlySalaries', 'categories'));
    }

    // Salary
    public function salariesIndex(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $payments = SalaryPayment::with('user')->where('month', $month)->orderBy('user_id')->paginate(20);
        $users = User::orderBy('name')->get();
        return view('admin.accounts.salaries.index', compact('payments', 'month', 'users'));
    }

    public function salariesCreate()
    {
        $users = User::orderBy('name')->get();
        $pendingAdvances = SalaryAdvance::where('status', 'pending')->with('user')->orderByDesc('advance_date')->limit(10)->get();
        return view('admin.accounts.salaries.create', compact('users', 'pendingAdvances'));
    }

    public function salariesStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|date_format:Y-m',
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'paid_on' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'reference_no' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data['allowances'] = $data['allowances'] ?? 0;
        $data['deductions'] = $data['deductions'] ?? 0;
        $data['net_salary'] = ($data['basic_salary'] + $data['allowances']) - $data['deductions'];
        $data['created_by'] = auth()->id();

        $payment = SalaryPayment::create($data);

        SalaryPaymentLog::create([
            'salary_payment_id' => $payment->id,
            'action' => 'created',
            'details' => json_encode($payment->toArray()),
            'changed_by' => auth()->id(),
        ]);

        return redirect()->route('admin.accounts.salaries.show', $payment->id)
            ->with('success', 'Salary payment recorded successfully.');
    }

    // Advances
    public function advancesIndex()
    {
        $advances = SalaryAdvance::with(['user', 'installments'])->orderByDesc('advance_date')->paginate(20);
        $users = User::orderBy('name')->get();
        
        // Debug: Check data types
        if ($advances->count() > 0) {
            $firstAdvance = $advances->first();
            Log::info('Advance date type: ' . gettype($firstAdvance->advance_date));
            Log::info('Advance date value: ' . $firstAdvance->advance_date);
            if ($firstAdvance->installments->count() > 0) {
                $firstInstallment = $firstAdvance->installments->first();
                Log::info('Installment pay_date type: ' . gettype($firstInstallment->pay_date));
                Log::info('Installment pay_date value: ' . $firstInstallment->pay_date);
            }
        }
        
        return view('admin.accounts.advances.index', compact('advances', 'users'));
    }

    public function advancesStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'advance_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $data['created_by'] = auth()->id();
        SalaryAdvance::create($data);
        return back()->with('success', 'Advance recorded.');
    }

    public function advancesSettle(Request $request, SalaryAdvance $advance)
    {
        // Allow partial settlement by creating an installment; when fully settled, mark settled
        $data = $request->validate([
            'settled_via' => 'required|in:salary_deduction,manual',
            'settled_on' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string|max:255',
        ]);

        SalaryAdvanceInstallment::create([
            'salary_advance_id' => $advance->id,
            'amount' => $data['amount'],
            'pay_date' => $data['settled_on'],
            'method' => $data['settled_via'],
            'notes' => $data['notes'] ?? null,
            'created_by' => auth()->id(),
        ]);

        $paid = $advance->installments()->sum('amount');
        if ($paid >= $advance->amount) {
            $advance->update([
                'status' => 'settled',
                'settled_via' => $data['settled_via'],
                'settled_on' => $data['settled_on'],
            ]);
        }

        return back()->with('success', 'Advance installment recorded.');
    }

    public function employeeSummary(User $user)
    {
        $totalPaid = SalaryPayment::where('user_id', $user->id)->sum('net_salary');
        $byMonth = SalaryPayment::where('user_id', $user->id)
            ->selectRaw('month, SUM(net_salary) as total')
            ->groupBy('month')->orderBy('month', 'desc')->get();

        $totalAdv = SalaryAdvance::where('user_id', $user->id)->sum('amount');
        $pendingAdv = SalaryAdvance::where('user_id', $user->id)->where('status','pending')->sum('amount');
        $settledAdv = SalaryAdvance::where('user_id', $user->id)->where('status','settled')->sum('amount');

        return view('admin.accounts.salaries.employee-summary', compact('user','totalPaid','byMonth','totalAdv','pendingAdv','settledAdv'));
    }

    public function salariesShow(SalaryPayment $payment)
    {
        $payment->load(['user', 'paymentNotes.author', 'logs.user']);
        return view('admin.accounts.salaries.show', compact('payment'));
    }

    public function salariesDestroy(SalaryPayment $payment)
    {
        SalaryPaymentLog::create([
            'salary_payment_id' => $payment->id,
            'action' => 'deleted',
            'details' => json_encode($payment->toArray()),
            'changed_by' => auth()->id(),
        ]);
        $payment->delete();
        return back()->with('success', 'Salary payment deleted.');
    }

    public function salariesEdit(SalaryPayment $payment)
    {
        $users = User::orderBy('name')->get();
        return view('admin.accounts.salaries.edit', compact('payment', 'users'));
    }

    public function salariesUpdate(Request $request, SalaryPayment $payment)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|date_format:Y-m',
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'paid_on' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'reference_no' => 'nullable|string|max:100',
        ]);
        $data['allowances'] = $data['allowances'] ?? 0;
        $data['deductions'] = $data['deductions'] ?? 0;
        $data['net_salary'] = ($data['basic_salary'] + $data['allowances']) - $data['deductions'];

        $before = $payment->toArray();
        $payment->update($data);
        $after = $payment->toArray();

        SalaryPaymentLog::create([
            'salary_payment_id' => $payment->id,
            'action' => 'updated',
            'details' => json_encode(['before' => $before, 'after' => $after]),
            'changed_by' => auth()->id(),
        ]);

        return redirect()->route('admin.accounts.salaries.show', $payment->id)->with('success', 'Salary updated.');
    }

    public function salariesAddNote(Request $request, SalaryPayment $payment)
    {
        $data = $request->validate([
            'note' => 'required|string|max:1000',
        ]);
        $note = SalaryPaymentNote::create([
            'salary_payment_id' => $payment->id,
            'note' => $data['note'],
            'created_by' => auth()->id(),
        ]);
        return back()->with('success', 'Note added.');
    }

    // Expenses
    public function expensesIndex(Request $request)
    {
        $query = Expense::with(['category', 'creator'])->orderBy('expense_date', 'desc');
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('expense_date', [$request->start_date, $request->end_date]);
        }
        $expenses = $query->paginate(20);
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('admin.accounts.expenses.index', compact('expenses', 'categories'));
    }

    public function expensesCreate()
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('admin.accounts.expenses.create', compact('categories'));
    }

    public function expensesStore(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data['created_by'] = auth()->id();
        $expense = Expense::create($data);

        ExpenseLog::create([
            'expense_id' => $expense->id,
            'action' => 'created',
            'details' => json_encode($expense->toArray()),
            'changed_by' => auth()->id(),
        ]);

        return redirect()->route('admin.accounts.expenses.index')->with('success', 'Expense added successfully.');
    }

    public function expensesDestroy(Expense $expense)
    {
        ExpenseLog::create([
            'expense_id' => $expense->id,
            'action' => 'deleted',
            'details' => json_encode($expense->toArray()),
            'changed_by' => auth()->id(),
        ]);
        $expense->delete();
        return back()->with('success', 'Expense deleted.');
    }

    public function expensesEdit(Expense $expense)
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('admin.accounts.expenses.edit', compact('expense', 'categories'));
    }

    public function expensesUpdate(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);
        $before = $expense->toArray();
        $expense->update($data);
        $after = $expense->toArray();

        ExpenseLog::create([
            'expense_id' => $expense->id,
            'action' => 'updated',
            'details' => json_encode(['before' => $before, 'after' => $after]),
            'changed_by' => auth()->id(),
        ]);

        return redirect()->route('admin.accounts.expenses.index')->with('success', 'Expense updated.');
    }

    public function expensesShow(Expense $expense)
    {
        $expense->load(['category', 'creator', 'logs.user']);
        return view('admin.accounts.expenses.show', compact('expense'));
    }

    // Expense categories edit/toggle
    public function categoriesEdit(ExpenseCategory $category)
    {
        return view('admin.accounts.categories.edit', compact('category'));
    }

    public function categoriesUpdate(Request $request, ExpenseCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,' . $category->id,
        ]);
        $category->update(['name' => $data['name']]);
        return redirect()->route('admin.accounts.categories.index')->with('success', 'Category updated.');
    }

    // Categories
    public function categoriesIndex()
    {
        $categories = ExpenseCategory::orderBy('name')->paginate(20);
        return view('admin.accounts.categories.index', compact('categories'));
    }

    public function categoriesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name',
        ]);
        ExpenseCategory::create(['name' => $data['name'], 'is_active' => true]);
        return back()->with('success', 'Category added.');
    }

    public function categoriesToggle(ExpenseCategory $category)
    {
        $category->update(['is_active' => !$category->is_active]);
        return back()->with('success', 'Category status updated.');
    }
}


