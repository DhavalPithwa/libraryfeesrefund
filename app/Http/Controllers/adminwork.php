<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\FeeRequest;
use Hash;
use Auth;
use Excel;
use Route;
use Response;
use Storage;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Mail\Sendotp;
use App\Mail\requeststatus;
use App\Mail\changepassword;

class adminwork extends Controller
{
    
    public function index()
    {
        if (Auth::user()->type == 0 or Auth::user()->type == 2) {

            $nvdata = FeeRequest::where('status', 0)->get();
            $updata = FeeRequest::where('status', 1)->get();
            $rjdata = FeeRequest::where('status', 2)->get();
            $cmdata = FeeRequest::where('status', 3)->get();
            // $user = Auth::user();
            foreach ($nvdata as $d) {
                $name = Student::where('enroll', $d->enroll)->select('name')->first();
                //dd($name->name);
                $d->name = $name->name;
            }
            foreach ($updata as $upd) {
                $name = Student::where('enroll', $upd->enroll)->select('name')->first();
                //dd($name->name);
                $upd->name = $name->name;
            }
            foreach ($rjdata as $rjd) {
                $name = Student::where('enroll', $rjd->enroll)->select('name')->first();
                //dd($name->name);
                $rjd->name = $name->name;
            }
            foreach ($cmdata as $cmd) {
                $name = Student::where('enroll', $cmd->enroll)->select('name')->first();
                //dd($name->name);
                $cmd->name = $name->name;
            }
            //dd($data);
            return view('Admin.adminhome', compact('nvdata', 'cmdata', 'updata', 'rjdata'));
        } else {
            return redirect()->to('/');
        }
    }

    public function report()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        if (Auth::user()->type == 0 or Auth::user()->type == 2) {
            $nvdata = FeeRequest::where('status', 0)->whereYear('created_at', '=', $year)->whereMonth('created_at', $month)->get();
            $updata = FeeRequest::where('status', 1)->whereYear('created_at', '=', $year)->whereMonth('created_at', $month)->get();
            $rjdata = FeeRequest::where('status', 2)->whereYear('created_at', '=', $year)->whereMonth('created_at', $month)->get();
            $cmdata = FeeRequest::where('status', 3)->whereYear('paydate', '=', $year)->whereMonth('paydate', $month)->get();
            foreach ($nvdata as $d) {
                $name = Student::where('enroll', $d->enroll)->select('name')->first();
                //dd($name->name);
                $d->name = $name->name;
            }
            foreach ($updata as $upd) {
                $name = Student::where('enroll', $upd->enroll)->select('name')->first();
                //dd($name->name);
                $upd->name = $name->name;
            }
            foreach ($rjdata as $rjd) {
                $name = Student::where('enroll', $rjd->enroll)->select('name')->first();
                //dd($name->name);
                $rjd->name = $name->name;
            }
            foreach ($cmdata as $cmd) {
                $name = Student::where('enroll', $cmd->enroll)->select('name')->first();
                //dd($name->name);
                $cmd->name = $name->name;
            }
            if (Auth::user()->type == 0) {
                return view('Admin.adminreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));    
            } else {
                return view('Librarian.libreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));
            }
            
        } else {
            return redirect()->to('/');
        }
    }


    public function datechnagerept($month, $year)
    {
        if (Auth::user()->type == 0 or Auth::user()->type == 2) {
            $nvdata = FeeRequest::where('status', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $updata = FeeRequest::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $rjdata = FeeRequest::where('status', 2)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $cmdata = FeeRequest::where('status', 3)->whereYear('paydate', $year)->whereMonth('paydate', $month)->get();
            foreach ($nvdata as $d) {
                $name = Student::where('enroll', $d->enroll)->select('name')->first();
                //dd($name->name);
                $d->name = $name->name;
            }
            foreach ($updata as $upd) {
                $name = Student::where('enroll', $upd->enroll)->select('name')->first();
                //dd($name->name);
                $upd->name = $name->name;
            }
            foreach ($rjdata as $rjd) {
                $name = Student::where('enroll', $rjd->enroll)->select('name')->first();
                //dd($name->name);
                $rjd->name = $name->name;
            }
            foreach ($cmdata as $cmd) {
                $name = Student::where('enroll', $cmd->enroll)->select('name')->first();
                //dd($name->name);
                $cmd->name = $name->name;
            }
            if (Auth::user()->type == 0) {
                return view('Admin.adminreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));    
            } else {
                return view('Librarian.libreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));
            }
        } else {
            return redirect()->to('/');
        }
    }


    public function login(Request $req)
    {
        //dd($req->input());
        if ($req->input('role') == 0) {
            $input = $req->only(['email'=>'email','password'=>'password']);
            if (Auth::guard('web')->attempt($input)) {
                $user = Auth::user();
                $req->session()->put(['email'=>$user['email'],'name'=>$user['name']]);
                if ($user['type'] == 0) {
                    toast('Login As Admin', 'success')->width('20em');
                    return redirect()->to('/admin');
                } elseif($user['type'] == 1) {
                    toast('Login As Accountant', 'success')->width('20em');
                    return redirect()->to('/accountent');
                } elseif($user['type'] == 2) {
                    toast('Login As Librarian', 'success')->width('20em');
                    return redirect()->to('/librarian');
                } else {
                    toast('Login As Faculty', 'success')->width('20em');
                    return redirect()->to('/faculty');
                }
            } else {
                toast('Check Credentials', 'error')->width('20em');
                return back();
            }
        } else {
            $input = $req->only(['enroll'=>'enroll','password'=>'password']);
            //dd($input);
            if (Auth::guard('student')->attempt($input)) {
                $user = Auth::guard('student')->user();
                $req->session()->put(['email'=>$user['email'],'name'=>$user['name']]);
                toast('Login As Student', 'success')->width('20em');
                return redirect()->to('/student');
            } else {
                toast('Check Credentials', 'error')->width('20em');
                return back();
            }
        }
    }

    public function adduser(Request $req)
    {
        $type = 'Select Role';
        if (Auth::user()->type == 0) {

            $validatedData = $req->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'number' => 'numeric|required|digits:10',
                'role' =>   'required|not_in:'.$type,
            ]);

            if ($req->input('userid')) {

                $user = User::where('id', $req->input('userid'))->first();
                $user->name = $req->input('name');
                $user->email = $req->input('email');
                $user->phone_no = $req->input('number');
                if ($req->role == "Accountant") {
                    $user->type = 1;
                } elseif ($req->role == "Librarian") {
                    $user->type = 2;
                } elseif ($req->role == "Faculty") {
                    $user->type = 3;
                }
                $user->save();

                $data = User::where('type', 1)->get();
                toast('Authoritie Detail Update Successful.', 'success')->width('20em');
                return redirect()->to('/add_user');
            } else {
                
                $user = new User;
                $user->name = $req->name;
                $user->email = $req->email;
                $user->phone_no = $req->number;
                $user->password = Hash::make($req->number);
                if ($req->role == "Accountant") {
                    $user->type = 1;
                } elseif ($req->role == "Librarian") {
                    $user->type = 2;
                } elseif ($req->role == "Faculty") {
                    $user->type = 3;
                }
                $user->save();
                $data = User::where('type', 1)->get();
                toast('Authoritie Add Successful.', 'success')->width('20em');
                return redirect()->to('/add_user');
            }

        } else {
            return redirect()->to('/');
        }
    }


    public function addstud(Request $req)
    {
        if (Auth::user()->type == 0) {

            $validatedData = $req->validate([
                'customFile' => 'required|max:255',
            ]);
            
            Excel::import(new StudentImport, $req->file('customFile'));
            
            $data = Student::all();
            toast('Students Add Successful.', 'success')->width('20em');
            return view('Admin.admin_add_stud', compact('data'));
        
        } else {
            return redirect()->to('/');
        }
    }

    public function addsinglestud(Request $req)
    {
        if (Auth::user()->type == 0) {

            // dd($req->input());
            $this->validate($req, [

            'enroll' => 'required|numeric',
            'Name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'course' => 'required',
            'sem' => 'required',

            ]);
            
            $stud = new Student;
            $stud->enroll = $req->input('enroll');
            $stud->name = $req->input('Name');
            $stud->email = $req->input('email');
            $stud->Phone_No = $req->input('phone');
            $stud->password = Hash::make($req->input('phone'));
            $stud->course = $req->input('course');
            $stud->semester = $req->input('sem');
            $stud->save();
            toast('Students Add Successful.', 'success')->width('20em');
            return back();
        
        } else {
            return redirect()->to('/');
        }
    }

    public function export()
    {
        toast('Students Data Downloaded.', 'success')->width('22em');
        return Excel::download(new StudentExport, 'students.csv');
    }

    public function viewstuddetail($id)
    {
        if (Auth::user()->type == 0) {
            $user = Student::where('enroll', $id)->first();
            return view('Admin.viewstuddetail', compact('user'));
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
                $details = [
                    'title' => 'Title: Mail From L.J Library fee Refund System',
                    'body' => 'We get your password chnage request. it will chnaged in 2 to 3 min.'
                ];
                \Mail::to($user->email)->send(new requeststatus($details));
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

    public function sendotp(Request $req)
    {
        //dd($req->input());
        $email = $req->input('email');
        $user = User::where('email', $req->input('email'))->first();
        $stud = Student::where('email', $req->input('email'))->first();
        if ($user or $stud) {
            //dd($user.$stud);
            $otp = rand(99999, 999999);
            $details = [
            'title' => 'Title: Mail From L.J Library fee Refund System',
            'body' => 'This is your OTP for forgot Password : '.$otp
            ];

            \Mail::to($req->input('email'))->send(new Sendotp($details));
            //dd($otp);
            return view('forgotpasswo', compact('otp', 'email'));
            
        } else {
            Alert::error('Forgot Password', 'You are not Registered yet');
            return back()->withInput($req->input());
        }
    }

    public function checkvalue(Request $req)
    {
        //dd($req->input());
        $otp = $req->input('otp');
        $userotp = $req->input('userotp');
        $email = $req->input('email');
        $npassword = $req->input('npassword');
        $ncpassword = $req->input('ncpassword');
        if ($req->input('otp') != $req->input('userotp')) {
            Alert::error('OTP', 'Your OTP is not Correct.');
            return view('forgotpasswo', compact('otp', 'email'));
        } else {
            //dd($npassword. $ncpassword);
            if ($npassword !== $ncpassword) {
                Alert::error('Password', 'Both Password Must be Same.');
                return view('forgotpasswo', compact('otp', 'email'));
            } else {
                $user = Student::where('email', $email)->first();
                if ($user) {
                    //dd("Student");
                    $user->password = Hash::make($npassword);
                    $user->save();
                    Alert::success('Password', 'Password Chnaged.');
                } else {
                    //dd("Admin");
                    $user = User::where('email', $email)->first();
                    $user->password = Hash::make($npassword);
                    $user->save();
                    Alert::success('Password', 'Password Chnaged.');
                }
                $details = [
                    'title' => 'Title: Mail From L.J Library fee Refund System',
                    'body' => 'We get your password chnage request. it will chnaged in 2 to 3 min.'
                ];
                \Mail::to($user->email)->send(new requeststatus($details));
                return redirect()->to('/');
            }
        }
        
    }


    public function logout(Request $req)
    {
        $req->session()->flush();
        toast('Logout Success.', 'success')->width('20em');
        return redirect()->to('/');
    }
}
