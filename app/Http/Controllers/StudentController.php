<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\FeeRequest;
use Hash;
use Auth;
use Excel;
use Route;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
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
        
        $user = Auth::guard('student')->user();
        $data = FeeRequest::where('enroll', $user['enroll'])->first();
        if ($data) {
            Alert::error('Request', 'You alreday Submit One Request');
            return back();
        } else {
            $this->validate($request, [

            'lfeeno' => 'required',
            'amt' => 'required',
            'lfeefile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'sem6feefile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gradsfile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'passbookfile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cancelceqfile' => 'required|image|mimes:jpeg,png,jpg|max:2048',

            ]);
            $amount = intval($request->input('amt'));
            $destinationPath = public_path('/images');
            

            if (intval($request->input('amt')) > 2500) {
                
                Alert::error('Password', 'Current Password Not Match.');
                return back();

            }

            if (!$request->hasFile('lfeefile')) {
                $amount = $amount - 100;
                $lfeeimage = null;
            } else {
                
                $lfeimage = $request->file('lfeefile');
                $lfeeimage = $user['enroll'].'_LFee'.'.'.$lfeimage->getClientOriginalExtension();
                $lfeimage->move($destinationPath, $lfeeimage);

            }
            if (!$request->hasFile('sem6feefile')) {
                $amount = $amount - 100;
                $sem6feeimage = null;
            } else {
                
                $s6feeimage = $request->file('sem6feefile');
                $sem6feeimage = $user['enroll'].'_sem6fee'.'.'.$s6feeimage->getClientOriginalExtension();
                $s6feeimage->move($destinationPath, $sem6feeimage);

            }
            //echo $amount;

        
            $ghimage = $request->file('gradsfile');
            $gradsimage = $user['enroll'].'_gradhs'.'.'.$ghimage->getClientOriginalExtension();
            $ghimage->move($destinationPath, $gradsimage);
            
            $passimage = $request->file('passbookfile');
            $passbookimage = $user['enroll'].'_passbook'.'.'.$passimage->getClientOriginalExtension();
            $passimage->move($destinationPath, $passbookimage);
            
            $ccheimage = $request->file('cancelceqfile');
            $cancelceqimage = $user['enroll'].'_canche'.'.'.$ccheimage->getClientOriginalExtension();
            $ccheimage->move($destinationPath, $cancelceqimage);

            $req = new FeeRequest;

            $req->enroll = $user['enroll'];
            $req->lfees_no = $request->input('lfeeno');
            $req->lfees_path = $lfeeimage;
            $req->sem6fee_path = $sem6feeimage;
            $req->gtugrade_path = $gradsimage;
            $req->passbook_path = $passbookimage;
            $req->cheque_path = $cancelceqimage;
            $req->amount = $request->input('amt');
            $req->status = 0;
            $req->save();
            return redirect()->to('/student');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
