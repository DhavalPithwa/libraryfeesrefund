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
        if (Auth::user()) {

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


    public function extedreq($id)
    {
        if (Auth::user()) {
            $data = FeeRequest::where('enroll', $id)->first();
            $user = Student::where('enroll', $id)->first();
            return view('Admin.viewrequest', compact('user', 'data'));
        } else {
            return redirect()->to('/');
        }
    }
    public function viewstuddetail($id)
    {
        if (Auth::user()) {
            $user = Student::where('enroll', $id)->first();
            return view('Admin.viewstuddetail', compact('user'));
        } else {
            return redirect()->to('/');
        }
    }


    public function report()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        if (Auth::user()) {
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
            return view('Admin.adminreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));
        } else {
            return redirect()->to('/');
        }
    }


    public function datechnagerept($month, $year)
    {
        if (Auth::user()) {
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
            return view('Admin.adminreport', compact('nvdata', 'updata', 'rjdata', 'cmdata', 'month', 'year'));
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

    public function addacc(Request $req)
    {
        $type = 'Select Role';
        if (Auth::user()) {

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
                toast('Accountant Detail Update Successful.', 'success')->width('20em');
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
                toast('Accountant Add Successful.', 'success')->width('20em');
                return redirect()->to('/add_user');
            }

        } else {
            return redirect()->to('/');
        }
    }

    public function passorrejectreq(Request $req)
    {
        if (Auth::user()) {
            
            //dd($req->input());
            if ($req->input('rejectclick') >= 1) {
                $validatedData = $req->validate([
                'reject_reason' => 'required',
                ]);
            }
            $request = FeeRequest::where('enroll', $req->input('reqenroll'))->first();
            $stud = Student::where('enroll', $req->input('reqenroll'))->first();
            if ($req->input('reject_reason') == null and $req->input('rejectclick') < 1) {
                // Cut Pendding Book Amount
                if ($req->input('pendingbook') != null) {
                    $books = explode(',', $req->input('pendingbook'));
                    //dd($books);
                    foreach ($books as $value) {
                        $key = explode('-', $value);
                        if (count($key) >= 2) {
                            $request->amount = $request->amount - (int)$key[1];
                        }
                    }
                }
                if ($request->amount < 0) {
                    //dd($request->amount);
                    //When Amount after Cut pending book money is less then 0
                    
                    $request->reason = "Student Need To Pay Us";
                    $request->pendingbook = "Request Accepted & Amount Deducted.";
                    $request->status = 2;
                    $request->amount = abs($request->amount);
                    $request->save();

                    $details = [
                        
                        'title' => 'Title: Mail From L.J Library fee Refund System',
                        'body' => 'After Cut your pending book amount from payable amount. it shows you have to pay ' .abs($request->amount). ' INR to L.J So Your Request Is Rejected. Come & Pay This amount First.'

                    ];
                    \Mail::to($stud->email)->send(new requeststatus($details));

                    Alert::error('Request Rejected', "Student Need To Pay ". abs($request->amount). "INR To Us.");
                } else {
                    
                    $request->reason = "Under Payment";
                    $request->pendingbook = "Request Accepted & Amount Deducted.";
                    $request->status = 1;
                    $request->save();

                    $details = [
                        'title' => 'Title: Mail From L.J Library fee Refund System',
                        'body' => 'Your request is Under Payment. Your Amount is '.$request->amount
                    ];
                    \Mail::to($stud->email)->send(new requeststatus($details));
                    
                    Alert::success('Request', 'Request Goes Into Under Payment.');
                }
                return redirect()->to('/admin');
            } else {
                if ($req->input('rejectclick') == 1) {
                    //Reject Request
        
                    if ($request->reason != "Student Need To Pay Us") {
                        $request->reason = $req->input('reject_reason');
                    } else {
                        $details = [
                            'title' => 'Title: Mail From L.J Library fee Refund System',
                            'body' => 'Your Request Is Rejected. Because of '. $request->reason
                        ];
                        \Mail::to($stud->email)->send(new requeststatus($details));
                    }
                    $request->status = 2;
                    $request->save();
                    Alert::success('Request', 'Request Rejected Success.');
                } else {
                    //Set Pending Book Detail Success.
                    $details = [
                        'title' => 'Title: Mail From L.J Library fee Refund System',
                        'body' => 'You have pending books. AS ' .$req->input('reject_reason')
                    ];
                    \Mail::to($stud->email)->send(new requeststatus($details));
                    $request->pendingbook = $req->input('reject_reason');
                    $request->status = 0;
                    $request->save();
                    Alert::success('Pending Book', 'Set Pending Book Detail Success.');
                }
                return redirect()->to('/admin');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function addstud(Request $req)
    {
        if (Auth::user()) {

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
        if (Auth::user()) {

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

    public function export()
    {
        toast('Students Data Downloaded.', 'success')->width('22em');
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    public function cmexport($month, $year)
    {
        //dd($year);
        $cmdata = FeeRequest::where('status', 3)->whereYear('paydate', $year)->whereMonth('paydate', $month)->get();
        foreach ($cmdata as $cmd) {
                $name = Student::where('enroll', $cmd->enroll)->select('name')->first();
                //dd($name->name);
                $cmd->name = $name->name;
        }
        $filename = "completedreq_".$month."_".$year.".csv";
        //dd($cmdata);
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Req_id', 'enroll', 'name', 'lfees_no', 'Status', 'completedby', 'paydate', 'tran_id', 'amount'));

        foreach ($cmdata as $row) {
            if ($row['tran_id'] != null) {
                fputcsv($handle, array($row['Req_id'], $row['enroll'], $row['name'], $row['lfees_no'],
                    "Completed", $row['completedby'], $row['paydate'], $row['tran_id'], $row['amount']));
            } else {
                fputcsv($handle, array($row['Req_id'], $row['enroll'], $row['name'], $row['lfees_no'], $row['completedby'], $row['paydate'], "NULL", $row['amount']));
            }
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);
        
    }

    public function upexport($month, $year)
    {
        //dd($month);
        $updata = FeeRequest::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        
        foreach ($updata as $upd) {
                $name = Student::where('enroll', $upd->enroll)->select('name')->first();
                //dd($name->name);
                $upd->name = $name->name;
        }
        $filename = "underpaymentreq_".$month."_".$year.".csv";
        //dd($updata);
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Req_id', 'enroll', 'name', 'lfees_no', 'Status', 'amount'));

        foreach ($updata as $row) {
            fputcsv($handle, array($row['Req_id'], $row['enroll'], $row['name'], $row['lfees_no'], "Under Payment", $row['amount']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        //dd($cmdata);
        return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }

    public function nvexport($month, $year)
    {
        //dd($month);
        $nvdata = FeeRequest::where('status', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        
        foreach ($nvdata as $nvd) {
                $name = Student::where('enroll', $nvd->enroll)->select('name')->first();
                //dd($name->name);
                $nvd->name = $name->name;
        }
        $filename = "notvarifiedreq_".$month."_".$year.".csv";
        //dd($updata);
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Req_id', 'enroll', 'name', 'lfees_no', 'Status', 'amount'));

        foreach ($nvdata as $row) {
            fputcsv($handle, array($row['Req_id'], $row['enroll'], $row['name'], $row['lfees_no'], "Not Varified Yet", $row['amount']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        //dd($cmdata);
        //toast('Students Data Downloaded.', 'success')->width('22em');
        return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }

    public function rjexport($month, $year)
    {
        //dd($month);
        $rjdata = FeeRequest::where('status', 2)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        
        foreach ($rjdata as $rjd) {
                $name = Student::where('enroll', $rjd->enroll)->select('name')->first();
                //dd($name->name);
                $rjd->name = $name->name;
        }
        $filename = "rejectedreq_".$month."_".$year.".csv";
        //dd($updata);
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Req_id', 'enroll', 'name', 'lfees_no', 'Status', 'Reason', 'amount'));

        foreach ($rjdata as $row) {
            fputcsv($handle, array($row['Req_id'], $row['enroll'], $row['name'], $row['lfees_no'], "Rejeted", $row['reason'], $row['amount']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        //dd($cmdata);
        return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);
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
