<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\FeeRequest;
use Hash;
use Auth;
use Excel;
use Route;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;

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
        $date = explode("/", $request->input('date'));
        $date = $date[1]."-".$date[0]."-".$date['2'];
        $user = Auth::user();
        $name = $user->id."-".$user->name;
        $tidcount = 0;
        //dd($name);
        foreach ($request->input('check') as $data) {
            $req = FeeRequest::where('enroll', $data)->first();
            $req->status = 3;
            $req->completedby = $name;
            $req->tran_id = $request->input($data);
            $req->reason = "Completed";
            $req->paydate = $date;
            $req->save();
            $tidcount = $tidcount + 1;
        }
        Alert::success('Accept Request', 'Request Accept & Transaction Id Saved..');
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
