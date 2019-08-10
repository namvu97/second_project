<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    public function getRegister()
    {
        return view('register_account');
    }

    public function postRegister(RegisterRequest $request)
    {
        $checkUserName = User::where("username", $request->username)->get()->Count();
        if ($checkUserName == 0) {
            $checkEmail = User::where("email", $request->email)->get()->Count();
            if ($checkEmail == 0) {
                $token = str_random(40);
                $passWord = str_random(8);
                User::insert(array("username" => $request->username, "email" => $request->email, "password" => bcrypt($passWord), "full_name" => $request->full_name, "token" => $token));
                $toEmail = $request->email;
                $toUserName = $request->username;
                Mail::send('mail_register', array('token' => $token, 'full_name' => $request->full_name, 'name' => $request->username, 'email' => $request->email, 'password' => $passWord), function($message) use ($toEmail, $toUserName) {
                    $message->from('namvu9701@gmail.com', 'Nam Vũ');
                    $message->to($toEmail, $toUserName)->subject('Đăng ký tài khoản!');
                });
            } else
                return redirect(url('registry?err=email-exists'));
        } else
            return redirect(url('registry?err=username-exists'));
        return redirect(url('registry?reg=success'));
    }
}
