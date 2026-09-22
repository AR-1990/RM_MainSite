<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectAuthenticatedUser();
        }

        return view('user.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'user',
            'is_active' => true,
        ], $remember)) {
            return back()
                ->withErrors(['email' => 'Invalid user login details.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        optional(Auth::user()->profile)->update([
            'last_login_at' => now(),
        ]);

        return redirect()->intended(route('myProperty'))
            ->with('success', 'Welcome back.');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectAuthenticatedUser();
        }

        return view('user.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'is_active' => true,
        ]);

        $user->profile()->create([
            'user_id' => $user->id,
            'phone' => $data['phone'] ?? null,
            'city' => $data['city'] ?? null,
            'is_portal_active' => true,
            'last_login_at' => now(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('myProperty')
            ->with('success', 'Your account has been created. You can now submit your property.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')
            ->with('success', 'You have been logged out.');
    }

    protected function redirectAuthenticatedUser(): RedirectResponse
    {
        if (Auth::user()->role === 'user') {
            return redirect()->route('myProperty');
        }

        return redirect()->route('admin.index');
    }
}
