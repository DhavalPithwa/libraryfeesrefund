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
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

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


    public function datechnagerept(Request $req)
    {
        //dd($req->input());
        $month = $req->input('month');
        $year = $req->input('year');
        //dd($year);
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
                } else {
                    toast('Login As Accountant', 'success')->width('20em');
                    return redirect()->to('/accountent');
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

    public function passorrejectreq(Request $req)
    {
        if (Auth::user()) {
            
            if ($req->input('rejectclick') == 1) {
                $validatedData = $req->validate([
                'reject_reason' => 'required',
                ]);
            }
            $request = FeeRequest::where('enroll', $req->input('reqenroll'))->first();
            if ($req->input('reject_reason') == null) {
                $request->reason = "Under Payment";
                $request->status = 1;
                $request->save();
                Alert::success('Request', 'Request Goes Into Under Payment.');
                return redirect()->to('/admin');
            } else {
                $request->reason = $req->input('reject_reason');
                $request->status = 2;
                $request->save();
                Alert::success('Request', 'Request Rejected Success.');
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
        //dd($cmdata);
        Response::download($filename, $filename, $headers);
        return back();
        //return redirect()->to('/admin_report');
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
        Response::download($filename, $filename, $headers);
        return redirect()->to('/admin_report');
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
        Response::download($filename, $filename, $headers);
        return redirect()->to('/admin_report');
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
        toast('Complete Request Data Downloaded.', 'success')->width('22em');
        Response::download($filename, $filename, $headers);
        return redirect()->to('/admin_report');
        //return Excel::download(new StudentExport, 'students.xlsx');
    }


    public function logout(Request $req)
    {
        $req->session()->flush();
        toast('Logout Success.', 'success')->width('20em');
        return redirect()->to('/');
    }
}
