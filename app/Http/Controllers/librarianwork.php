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

class librarianwork extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 2) {

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
            return view('Librarian.libhome', compact('nvdata', 'cmdata', 'updata', 'rjdata'));
        } else {
            return redirect()->to('/');
        }
    }

    public function extedreq($id)
    {
        if (Auth::user()->type == 2) {
            $data = FeeRequest::where('enroll', $id)->first();
            $user = Student::where('enroll', $id)->first();
            return view('Librarian.viewrequest', compact('user', 'data'));
        } else {
            return redirect()->to('/');
        }
    }


    public function passorrejectreq(Request $req)
    {
        if (Auth::user()->type == 2) {
            
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
