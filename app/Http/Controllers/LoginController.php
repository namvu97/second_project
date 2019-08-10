<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function getLogin()
    {
        if (session()->has('username') == false) {
            return view('login_account');
        }
        return view('home_layout');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        if ( !isset($user->username) || Hash::check($request->password, $user->password) == false || $user->verified == false) {
            return redirect(url('login?err=user-notexists'));
        } else {
            session(['user_id' => $user->id, 'username' => $request->username, 'change_password_at' => $user->change_password_at]);
            if (session('change_password_at') == null) {
                return redirect(url("password/change"));
            }
            return redirect('home'); 
        }
    }
}
