<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use Hash;
use Auth;
use Excel;
use Route;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;

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
                toast('Login As Admin', 'success')->width('20em');
                return redirect()->to('/admin');
            } else {
                toast('Login As Accountant', 'success')->width('20em');
                return redirect()->to('/accountent');
            }
        } else if (Auth::guard('student')->attempt($input)) {
            $user = Auth::guard('student')->user();
            $req->session()->put(['email'=>$user['email'],'name'=>$user['name']]);
            toast('Login As Student', 'success')->width('20em');
            return redirect()->to('/student');
        } else {
            toast('Check Credentials', 'error')->width('20em');
            return back();
        }
    }

    public function addacc(Request $req)
    {
        if (Auth::user()) {

            $validatedData = $req->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'number' => 'numeric|required|digits:10',
            ]);

            $accountent = new User;
            $accountent->name = $req->name;
            $accountent->email = $req->email;
            $accountent->phone_no = $req->number;
            $accountent->password = Hash::make($req->number);
            $accountent->type = 1;
            $accountent->save();

            $data = User::where('type', 1)->get();
            toast('Accountant Add Successful.', 'success')->width('20em');
            return view('Admin.admin_add_acc', compact('data'));
        
        } else {
            return redirect()->to('/');
        }
    }

    public function addstud(Request $req)
    {
        if (Auth::user()) {


            Excel::import(new StudentImport, $req->file('customFile'));
            
            $data = Student::all();
            toast('Students Add Successful.', 'success')->width('20em');
            return view('Admin.admin_add_stud', compact('data'));
        
        } else {
            return redirect()->to('/');
        }
    }

    public function chnagepass(Request $req)
    {
        if (Auth::user() or Auth::guard('student')->user()) {

            $validatedData = $req->validate([
                'cpass'     => 'required',
                'npass'     => 'required|min:3',
                'cnpass' => 'required|same:npass',
            ]);
            if (Auth::user()) {
                $capass = Auth::user()->password;
            } else {
                $capass = Auth::guard('student')->user()->password;
            }
            
            
            if (Hash::check($req->cpass, $capass)) {
                if (Auth::user()) {
                    $user = User::where('email', Auth::user()->email)->first();
                } else {
                    $user = Student::where('email', Auth::guard('student')->user()->email)->first();
                }
                $user->password = Hash::make($req->npass);
                $user->save();
                $req->session()->flush();
                Alert::success('Password', 'Password Chnaged.');
                return redirect()->to('/');
            } else {
                Alert::error('Password', 'Current Password Not Match.');
                return back();
            }
        
        } else {
            return redirect()->to('/');
        }
    }

    public function export()
    {
        toast('Students Data Downloaded.', 'success')->width('22em');
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        toast('Logout Success.', 'success')->width('20em');
        return redirect()->to('/');
    }
}
