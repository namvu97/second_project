<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Http\Requests\FindPasswordRequest;

class ForgotPasswordController extends Controller
{

    public function getPassword()
    {
        return view('get_password');
    }

    public function postPassword(FindPasswordRequest $request)
    {
        $userName = $request->get("username");
        $email = $request->get("email");
        $checkInfoUser = User::where("username", "=", $userName)->where("email", "=", $email)->get()->Count();
        if ($checkInfoUser == 1) {
            $passWord = str_random(8);
            User::where("username", "=", $userName)->where("email", "=", $email)->update(array("password" => bcrypt($passWord) ));
            Mail::send('forgot_password', array('name' => $userName, 'email' => $email, 'password' => $passWord), function($message) use ($email, $userName) {
                $message->from('namvu9701@gmail.com', 'Nam Vũ');
                $message->to($email, $userName)->subject('Lấy lại mật khẩu!');
            });
            return redirect(url("password/find?mess=get_password"));
        } else {
            return redirect(url("password/find?err=email_incorrect"));
        }
    }
}
