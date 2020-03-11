<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\FeeRequest;
use App\DocRequest;
use Hash;
use Auth;
use Excel;
use Route;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\requeststatus;

class FeeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\FeeRequest  $feeRequest
     * @return \Illuminate\Http\Response
     */
    public function show(FeeRequest $feeRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeeRequest  $feeRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeRequest $feeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeeRequest  $feeRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->input());
        $user = Auth::user();
        $name = $user->id."-".$user->name;
        //dd($name);
        $req = FeeRequest::where('enroll', $request->input('enroll'))->first();
        $req->status = 3;
        $req->completedby = $name;
        $req->tran_id = $request->input('trid');
        $req->reason = "Completed";
        $req->save();
        Alert::success('Accept Request', 'Request Accept & Transaction Id Saved..');
        return redirect()->to('/accountent');
    }

    public function updatewd(Request $request)
    {
        //dd($request->input());
        $validatedData = $request->validate([
                'date' => 'required',
            ]);
        $date = date("Y-m-d", strtotime($request->input('date')));
        
        $user = Auth::user();
        $name = $user->id."-".$user->name;
        //$tidcount = 0;
        
        if ($request->has('lfr-check')) {

            foreach ($request->input('lfr-check') as $data) {
                $req = FeeRequest::where('enroll', $data)->first();
                $stud = Student::where('enroll', $data)->first();
                $req->status = 3;
                $req->completedby = $name;
                $req->tran_id = $request->input('lfr-'.$data);
                $req->reason = "Completed";
                $req->paydate = $date;
                $req->save();
                //$tidcount = $tidcount + 1;
                $details = [
                    'title' => 'Title: Mail From L.J Library fee Refund System',
                    'body' => 'Your request is completed. Your Amount is '.$req->amount
                ];
                \Mail::to($stud->email)->send(new requeststatus($details));
            }

        }
        
        if ($request->has('lor-check')) {
            
            foreach ($request->input('lor-check') as $data) {
                $data = explode('-', $data);
                
                $req = DocRequest::where(['enroll'=>$data[0],'faculty_id'=>$data[1]])->first();
                $stud = Student::where('enroll', $data[0])->first();
                $req->status = 3;
                $req->completedby = $name;
                $req->tran_id = $request->input('lor-'.$data[0]);
                $req->paydate = $date;
                $req->amount = $request->input('loramt-'.$data[0]);
                $req->save();
                //$tidcount = $tidcount + 1;
                $details = [
                    'title' => 'Title: Mail From L.J Library fee Refund System',
                    'body' => 'Your request for LOR is completed.'
                ];
                \Mail::to($stud->email)->send(new requeststatus($details));
            }
                
        }
        
        if ($request->has('bof-check')) {

            foreach ($request->input('bof-check') as $data) {
                $req = DocRequest::where(['enroll'=>$data,'type'=>1])->first();
                $stud = Student::where('enroll', $data)->first();
                $req->status = 3;
                $req->completedby = $name;
                $req->tran_id = $request->input('bof-'.$data);
                $req->paydate = $date;
                $req->amount = $request->input('bofamt-'.$data);
                $req->save();
                //$tidcount = $tidcount + 1;
                $details = [
                    'title' => 'Title: Mail From L.J Library fee Refund System',
                    'body' => 'Your request for bonafide certificate is completed.'
                ];
                \Mail::to($stud->email)->send(new requeststatus($details));
            }

        }
        
        Alert::success('Requests Completed', 'Request Completed & Transaction Id Saved..');
        return redirect()->to('/accountent');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeeRequest  $feeRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeRequest $feeRequest)
    {
        //
    }
}
