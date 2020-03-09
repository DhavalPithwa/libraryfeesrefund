<?php
use App\User;
use App\Student;
use App\FeeRequest;
use App\DocRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/forgotpass', function () {
    return view('forgotpass');
});

Route::get('/forgotpasswo', function () {
    return view('forgotpasswordwithotp', compact('otp', 'email'));
});

Route::post('/sendotp', 'adminwork@sendotp');
Route::post('/checkvalue', 'adminwork@checkvalue');

Route::get('/logout', 'adminwork@logout');


Route::get('/profile', function () {
    if (Auth::user()) {
        $user = Auth::user();
        //dd($user->type);
        if ($user->type == 0) {
            return view('Admin.admin_profile', compact('user'));    
        } elseif ($user->type == 1) {
            return view('Accountent.acc_profile', compact('user'));    
        } elseif ($user->type == 2) {
            return view('Librarian.lib_profile', compact('user'));    
        } else {
            return view('Faculty.fac_profile', compact('user'));    
        }
        
    } else {
        return redirect()->to('/');
    }
});

Route::get('/add_user', function () {
    if (Auth::user()->type == 0) {
        $data = User::wherein('type', [1,2,3])->get();
        return view('Admin.admin_add_acc', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/add_stud', function () {
    if (Auth::user()->type == 0) {
        $data = Student::all();
        return view('Admin.admin_add_stud', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deletedetail/{id}', function ($id) {
    if (Auth::user()->type == 2) {
        FeeRequest::where('enroll', $id)->delete();
        Alert::success('Request Delete', 'Request Deleted Successfilly.');
        return redirect()->to('/admin');
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deleteuserdetail/{id}', function ($id) {
    if (Auth::user()->type == 0) {
        User::where('id', $id)->delete();
        Alert::success('Accountant Delete', 'Accountant Deleted Successfilly.');
        return back();
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deletestuddetail/{id}', function ($id) {
    if (Auth::user()->type == 0) {
        Student::where('enroll', $id)->delete();
        Alert::success('Student Delete', 'Student Deleted Successfilly.');
        return back();
    } else {
        return redirect()->to('/');
    }
});

Route::get('/admin', 'adminwork@index');
Route::get('/viewreqdetail/{id}', 'librarianwork@extedreq');
Route::get('/viewstuddetail/{id}', 'adminwork@viewstuddetail');

Route::get('/accountent', function () {
    if (Auth::user()->type == 1) {
        $updata = FeeRequest::where('status', 1)->get();
        foreach ($updata as $upd) {
            $name = Student::where('enroll', $upd->enroll)->select('name')->first();
            //dd($name->name);
            $upd->name = $name->name;
        }
        return view('Accountent.acchomewithdate', compact('updata'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/faculty', function () {
    if (Auth::user()->type == 3) {
        $data = DocRequest::where('faculty_id', Auth::user()->id)->get();
        foreach ($data as $d) {
            $name = Student::where('enroll', $d->enroll)->first();
            $d->sname = $name->name;
        }
        return view('Faculty.fachome', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/librarian', 'librarianwork@index');

Route::get('/student', function () {
    if (Auth::guard('student')->user()) {
        $data = FeeRequest::where('enroll', Auth::guard('student')->user()['enroll'])->first();
        return view('Student.studhome', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/stud_profile', function () {
    if (Auth::guard('student')->user()) {
        $user = Auth::guard('student')->user();
        return view('Student.stud_profile', compact('user'));
    } else {
        return redirect()->to('/');
    }
});


Route::get('/request', function () {
    if (Auth::guard('student')->user()) {
        $user = Auth::guard('student')->user();
        return view('Student.studrequest', compact('user'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/docrequest', function () {
    if (Auth::guard('student')->user()) {
        $users = User::where('type',3)->get();
        $lordata = DocRequest::where(['enroll'=>Auth::guard('student')->user()->enroll,'type'=>0])->get();
        foreach ($lordata as $data) {
            $name = User::where('id',$data->faculty_id)->first();
            $data->fname = $name->name;
        }
        $bfdata = DocRequest::where(['enroll'=>Auth::guard('student')->user()->enroll,'type'=>1])->get();
        return view('Student.studdocrequest', compact('users','lordata','bfdata'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/viewdocreqdetail/{id}/{fid}', 'StudentController@exteddocreq');

Route::get('/viewdocfreqdetail/{id}/{fid}', 'StudentController@exteddocfreq');

Route::get('/deletedocdetail/{id}/{fid}', function ($id,$fid) {
    if (Auth::guard('student')->user()) {
        if ($fid == 0) {
            DocRequest::where(['enroll'=>$id, 'type'=>1])->delete();    
        } else {
            DocRequest::where(['enroll'=>$id, 'faculty_id'=>$fid])->delete();    
        }
        Alert::success('Request Delete', 'Request Deleted Successfilly.');
        return redirect()->to('/docrequest');
    } else {
        return redirect()->to('/');
    }
});

Route::get('/editreq', function () {
    if (Auth::guard('student')->user()) {
        $user = Auth::guard('student')->user();
        $data = FeeRequest::where('enroll', $user['enroll'])->first();
        //dd($data->lfees_no);
        return view('Student.editrequest', compact('user', 'data'));
    } else {
        return redirect()->to('/');
    }
});

Route::post('/addsinglestud', 'adminwork@addsinglestud');
Route::post('/updateacc', 'adminwork@updateacc');
Route::get('/studaccept/{enroll}', 'StudentController@accept');
Route::get('/report', 'adminwork@report');
Route::get('/chnagedaterept/{month}/{year}', 'adminwork@datechnagerept')->name('chnagedaterept');
Route::post('/acceptreq', 'FeeRequestController@update');
Route::post('/acceptreqwd', 'FeeRequestController@updatewd');
Route::post('/sendreq', 'StudentController@store');
Route::post('/docreq', 'StudentController@docstore');
Route::post('/updatereq', 'StudentController@update');
Route::post('/updatestud', 'StudentController@updatestud');
Route::post('/adminlogin', 'adminwork@login');
Route::post('/adduser', 'adminwork@adduser');
Route::post('/passorrejectreq', 'librarianwork@passorrejectreq');
Route::post('/addstud', 'adminwork@addstud');
Route::post('/chnagepass', 'adminwork@chnagepass');
Route::get('/export', 'adminwork@export')->name('export');
Route::get('/cmexport/{month}/{year}', 'librarianwork@cmexport');
Route::get('/nvexport/{month}/{year}', 'librarianwork@nvexport');
Route::get('/upexport/{month}/{year}', 'librarianwork@upexport');
Route::get('/rjexport/{month}/{year}', 'librarianwork@rjexport');

