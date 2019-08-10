<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{

    public function getChangePassword()
    {
        return view('change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $user = User::where("username", session('username'))->first();
        if (Hash::check($request->get("old_password"), $user->password)) {
            if ($request->get("new_password") == $request->get("new_password_repeat")) {
                User::where("username", "=", session('username'))->update(array("password" => bcrypt($request->get("new_password")), "change_password_at" => Carbon::now()));
                session(['change_password_at' => Carbon::now()]);
            } else {
                return redirect(url("password/change?err=password_notmatch"));
            }
            return redirect(url("password/change?mess=success"));
        } else {
            return redirect(url("password/change?err=password_incorrect"));
        }
    }
}
