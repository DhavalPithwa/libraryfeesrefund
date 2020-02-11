<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\FeeRequest;
use Hash;
use Auth;
use Excel;
use Route;
use Validator;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\requeststatus;

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
                
                Alert::error('Amount', 'Amount Should be less then or equel to 2500.');
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
            $req->amount = $amount;
            $req->status = 0;
            $req->save();
            $details = [
                'title' => 'Title: Mail From L.J Library fee Refund System',
                'body' => 'We get your request from library fee refund. As soon as possible we will work on it and send you status of your request'
            ];
            \Mail::to($user['email'])->send(new requeststatus($details));
            Alert::success('Request', 'Your Request Send Successfully.');
            return redirect()->to('/student');
        }
        
    }

    public function accept($enroll)
    {
        //dd($enroll);
        $data = FeeRequest::where('enroll', $enroll)->first();
        $stud = Student::where('enroll', $enroll)->first();
        $books = explode(',', $data->pendingbook);
        foreach ($books as $value) {
            $key = explode('-', $value);
            if (count($key) >= 2) {
                $data->amount = $data->amount - (int)$key[1];
            }
        }
        if ($data->amount < 0) {
            $data->reason = "Student Need To Pay Us";
            $data->pendingbook = "Request Accepted & Amount Deducted.";
            $data->amount = abs($data->amount);
            $data->status = 2;
            $data->save();
            $details = [
                'title' => 'Title: Mail From L.J Library fee Refund System',
                'body' => 'Your Request Is Rejected. Because of Student Need To Pay Us.'
            ];
            \Mail::to($stud->email)->send(new requeststatus($details));
            Alert::error('Request Rejected', "You Need To Pay". abs($data->amount) ."INR To Us.");
        } else {
            $details = [
                'title' => 'Title: Mail From L.J Library fee Refund System',
                'body' => 'You accept that money Deduct from your amount. Now your amount = '. abs($data->amount)
            ];
            \Mail::to($stud->email)->send(new requeststatus($details));
            $data->pendingbook = "Request Accepted & Amount Deducted.";
            $data->save();
            Alert::success('Amount Deducted', 'Your Request Accepted Successfully.');
        }
        return redirect()->to('/student');
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
        $this->validate($request, [

            'lfeeno' => 'required',
            'lfeefile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'sem6feefile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gradsfile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'passbookfile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'cancelceqfile' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $user = Auth::guard('student')->user();
        $data = FeeRequest::where('enroll', $user['enroll'])->first();
        $amount = $data['amount'];
        $updatedata = FeeRequest::find($user['enroll']);

        if ($data['lfees_path'] == null or $data['sem6fee_path'] == null) {
            if ($request->hasFile('lfeefile')) {
                $amount = $amount + 100;
            }
            if ($request->hasFile('sem6feefile')) {
                $amount = $amount + 100;
            }
        }

        $destinationPath = public_path('/images');

        if ($request->hasFile('lfeefile')) {
            $lfeimage = $request->file('lfeefile');
            $lfeeimage = $user['enroll'].'_LFee'.'.'.$lfeimage->getClientOriginalExtension();
            $lfeimage->move($destinationPath, $lfeeimage);
            $updatedata->lfees_path = $lfeeimage;
        }

        if ($request->hasFile('sem6feefile')) {
            $s6feeimage = $request->file('sem6feefile');
            $sem6feeimage = $user['enroll'].'_sem6fee'.'.'.$s6feeimage->getClientOriginalExtension();
            $s6feeimage->move($destinationPath, $sem6feeimage);
            $updatedata->sem6fee_path = $sem6feeimage;
        }

        if ($request->hasFile('gradsfile')) {
            $ghimage = $request->file('gradsfile');
            $gradsimage = $user['enroll'].'_gradhs'.'.'.$ghimage->getClientOriginalExtension();
            $ghimage->move($destinationPath, $gradsimage);
            $updatedata->gtugrade_path = $gradsimage;
        }

        if ($request->hasFile('passbookfile')) {
            $passimage = $request->file('passbookfile');
            $passbookimage = $user['enroll'].'_passbook'.'.'.$passimage->getClientOriginalExtension();
            $passimage->move($destinationPath, $passbookimage);
            $updatedata->passbook_path = $passbookimage;
        }

        if ($request->hasFile('cancelceqfile')) {
            $ccheimage = $request->file('cancelceqfile');
            $cancelceqimage = $user['enroll'].'_canche'.'.'.$ccheimage->getClientOriginalExtension();
            $ccheimage->move($destinationPath, $cancelceqimage);
            $updatedata->cheque_path = $cancelceqimage;
        }
        $updatedata->lfees_no = $request->input('lfeeno');
        $updatedata->amount = $amount;
        $updatedata->save();
        $details = [
            'title' => 'Title: Mail From L.J Library fee Refund System',
            'body' => 'Your Request Is Updated.'
        ];
        \Mail::to($user['email'])->send(new requeststatus($details));
        Alert::success('Update Request', 'Your Request Updated Successfully.');
        return redirect()->to('/student');

        // var_dump($request->input());
        // dd($request->file());
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

    public function updatestud(Request $request)
    {
        //dd($req->input());
        $this->validate($request, [

            'enroll' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'course' => 'required',
            'sem' => 'required',

        ]);
        
        $stud = Student::where('enroll', $request->input('enroll'))->first();
        $stud->enroll = $request->input('enroll');
        $stud->name = $request->input('name');
        $stud->email = $request->input('email');
        $stud->Phone_No = $request->input('phone');
        $stud->course = $request->input('course');
        $stud->semester = $request->input('sem');
        $stud->save();
        Alert::success('Update success', 'Students Detail Update Successful.');
        return redirect()->to('/add_stud');
    }
}
