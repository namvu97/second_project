<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerificationController extends Controller
{

    public function getVerify($token)
    {
        $checkToken = User::where('token', $token)->count();
        if ($checkToken == 1) {
            User::where('token', $token)->update(array("verified" => 1));
            return redirect(url('registry?mess=verify-success'));
        } else
            return redirect(url('registry?err=user-notexists'));
    }
}
