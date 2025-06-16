<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')) {
            try {
                $credentials = $request->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    if ($user->status != 1) {
                        Auth::logout();
                        return redirect()->route('login')->withErrors(['error' => 'Your account is inactive. Please contact admin.']);
                    }
                    return redirect()->route($user->role.'.dashboard');
                }
                return redirect()->route('login')->withErrors(['error' => 'Invalid credentials.']);

            } catch (Exception $e) {
                return redirect()->route('login')->withErrors(['error' => 'Something went wrong.']);
            }
        } else {
            return view('admin.auth.login');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
}
