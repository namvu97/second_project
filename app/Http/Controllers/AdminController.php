<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    public function getMaster()
    {
        return redirect('login');
    }

    public function getHome()
    {
        return view('home_layout');
    }

    public function getInfoUser()
    {
        $userName = session('username');
        $data['arr'] = User::where('username', $userName)->first();
        return view('info_user', $data);
    }
}
