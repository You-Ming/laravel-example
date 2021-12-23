<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SigninController extends Controller
{
    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        //登入驗證
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //return redirect()->intended('dashbord');
            return 'success';
        }

        $user = User::where('email', $request->email)->first();

        //檢查使用者是否存在
        if (! $user) {
            return 'notfound';
        }

        //檢查密碼是否錯誤
        if (! Hash::check($request->password, $user->password)) {
            return 'passwordError';
        }

        return 'error';
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');
        return view('admin.layouts.logout');
    }

}
