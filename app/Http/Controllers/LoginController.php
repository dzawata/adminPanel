<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.pages.login');
    }

    public function authenticate(Request $request, AuthService $authService)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $auth = $authService->authenticate($credentials, $request);

        if ($auth->status) {

            return response()->json([
                'status' => true,
                'message' => 'Akun ditemukan!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Akun tidak ditemukan!'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
