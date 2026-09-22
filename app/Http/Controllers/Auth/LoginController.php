<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect non-admin portal users to the dedicated frontend login.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'user') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('user.login')
                ->withErrors(['email' => 'Please use the user login page for property submissions.']);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            // Log the logout action
            Log::info('User logged out', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email ?? 'unknown',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login')->with('success', 'You have been successfully logged out.');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            
            // Force logout even if there's an error
            Auth::logout();
            $request->session()->invalidate();
            
            return redirect('/login')->with('error', 'An error occurred during logout.');
        }
    }
}
