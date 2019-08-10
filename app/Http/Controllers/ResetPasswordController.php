<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;

class ResetPasswordController extends Controller
{

    public function resetPassword(Request $request)
    {
        $passWord = str_random(8);
        if ($request->input('resetid') != null) {
            User::whereIn('id', $request->input('resetid'))->update(array("password" => $passWord, "change_password_at" => null));
            $resetUser = User::whereIn('id', $request->input('resetid'))->get();
            foreach ($resetUser as $rows) {
                $email = $rows->email;
                $username = $rows->username;
                $password = $rows->password;
                Mail::send('blanks', array('name' => $username, 'email' => $email, 'password' => $password), function($message) use ($email, $username) {
                    $message->from('namvu9701@gmail.com', 'Nam Vũ');
                    $message->to($email, $username)->subject('Reset mật khẩu!');
                });
            }
            return redirect(url('admin/user?mess=reset-password'));
        } else
            return redirect(url('admin/user'));
    }
}
// php artisan make:schedule token
