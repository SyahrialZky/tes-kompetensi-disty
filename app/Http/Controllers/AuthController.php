<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // arahkan ke view login
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        return view('admin.dashboard.index'); // ini halaman yang akan diakses setelah login
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login.form');
    }

    public function change_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'confirm_password.required' => 'Konfirmasi password wajib diisi',
            'confirm_password.same' => 'Konfirmasi password tidak sesuai',

        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'errors' => $validator->errors()
                ]
            );
        }

        try {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return response()->json(
                    [
                        'status' => 'error',
                        'error' => 'Password lama tidak sesuai!'
                    ]
                );
            }

            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);


            // logout
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Password berhasil diubah, silahkan login kembali!',
                    'redirect' => '/login'
                ],
                200
            );
        } catch (\Exception $e) {
            // Handle any other errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
