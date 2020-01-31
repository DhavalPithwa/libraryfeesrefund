<?php
use App\User;
use App\Student;
use App\FeeRequest;

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

Route::get('/logout', 'adminwork@logout');


Route::get('/profile', function () {
    if (Auth::user()) {
        $user = Auth::user();
        return view('Admin.admin_profile', compact('user'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/add_acc', function () {
    if (Auth::user()) {
        $data = User::where('type', 1)->get();
        return view('Admin.admin_add_acc', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/add_stud', function () {
    if (Auth::user()) {
        $data = Student::all();
        return view('Admin.admin_add_stud', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deletedetail/{id}', function ($id) {
    if (Auth::user()) {
        //dd($id);
        FeeRequest::where('enroll', $id)->delete();
        Alert::success('Request Delete', 'Request Deleted Successfilly.');
        return redirect()->to('/admin');
    } else {
        return redirect()->to('/');
    }
});

Route::get('/admin', 'adminwork@index');
Route::get('/viewreqdetail/{id}', 'adminwork@extedreq');

Route::get('/accountent', function () {
    if (Auth::user()) {
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

Route::get('/acc_profile', function () {
    if (Auth::user()) {
        $user = Auth::user();
        return view('Accountent.acc_profile', compact('user'));
    } else {
        return redirect()->to('/');
    }
});

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

Route::get('/admin_report', 'adminwork@report');
Route::get('/chnagedaterept/{month}/{year}', 'adminwork@datechnagerept')->name('chnagedaterept');;
Route::post('/acceptreq', 'FeeRequestController@update');
Route::post('/acceptreqwd', 'FeeRequestController@updatewd');
Route::post('/sendreq', 'StudentController@store');
Route::post('/updatereq', 'StudentController@update');
Route::post('/adminlogin', 'adminwork@login');
Route::post('/addacc', 'adminwork@addacc');
Route::post('/passorrejectreq', 'adminwork@passorrejectreq');
Route::post('/addstud', 'adminwork@addstud');
Route::post('/chnagepass', 'adminwork@chnagepass');
Route::get('/export', 'adminwork@export')->name('export');
Route::get('/cmexport/{month}/{year}', 'adminwork@cmexport');
Route::get('/nvexport/{month}/{year}', 'adminwork@nvexport');
Route::get('/upexport/{month}/{year}', 'adminwork@upexport');
Route::get('/rjexport/{month}/{year}', 'adminwork@rjexport');
Route::post('/import', 'adminwork@import')->name('import');
