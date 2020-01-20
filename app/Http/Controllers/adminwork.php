<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class adminwork extends Controller
{
    public function login(Request $req)
    {
        $input = $req->only(['email'=>'email','password'=>'password']);
        if (Auth::guard('web')->attempt($input)) {
            // echo 'you are admin';
            $user = Auth::user();
            $req->session()->put(['email'=>$user['email'],'name'=>$user['name']]);
            if ($user['type'] == 0) {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/accountent');
            }
        } else if (Auth::guard('student')->attempt($input)) {
            echo 'student';
        } else {
            echo 'check creds.';
        }
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect()->to('/admin');
    }
}
