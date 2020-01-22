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

Route::get('/logout', 'adminwork@logout');

Route::get('/add_acc', function () {
    if (Auth::user()) {
        $data = User::where('type', 1)->get();
        return view('Admin.admin_add_acc', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/profile', function () {
    if (Auth::user()) {
        $user = Auth::user();
        return view('Admin.admin_profile', compact('user'));
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


Route::get('/add_stud', function () {
    if (Auth::user()) {
        $data = Student::all();
        return view('Admin.admin_add_stud', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/admin', function () {
    if (Auth::user()) {
        return view('Admin.adminhome');
    } else {
        return redirect()->to('/');
    }
});

Route::get('/accountent', function () {
    if (Auth::user()) {
        return view('Accountent.acchome');
    } else {
        return redirect()->to('/');
    }
});

Route::get('/student', function () {
    if (Auth::guard('student')->user()) {
        $data = FeeRequest::where('enroll' ,Auth::guard('student')->user()['enroll'])->first();
        return view('Student.studhome' ,compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::post('/adminlogin', 'adminwork@login');
Route::post('/sendreq', 'StudentController@store');
Route::post('/addacc', 'adminwork@addacc');
Route::post('/addstud', 'adminwork@addstud');
Route::post('/chnagepass', 'adminwork@chnagepass');
Route::get('/export', 'adminwork@export')->name('export');
Route::post('/import', 'adminwork@import')->name('import');
