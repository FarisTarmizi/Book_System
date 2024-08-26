<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    //admin
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->role === 1)
            return redirect()->intended(route('admin.home', absolute: false));
        else {
            Auth::guard('web')->logout();
            return redirect()->intended(route('welcom   e'))->with('error', 'You are not authorized to access this page');
        }
    }

    //borrower
    public function create_b(): View
    {
        return view('auth.login_b');
    }

    public function store_b(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->role === 0 || $user->role === 2)
            return redirect()->intended(route('borrower.home'));
        else {
            Auth::guard('web')->logout();
            return redirect()->intended(route('welcome'))->with('error', 'You are not authorized to access this page');
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Thank You! See You Again:)');
    }
}
