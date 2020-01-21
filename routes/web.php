<?php
use App\User;
use App\Student;
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

Route::post('/adminlogin', 'adminwork@login');
Route::post('/addacc', 'adminwork@addacc');
Route::post('/addstud', 'adminwork@addstud');
Route::post('/chnagepass', 'adminwork@chnagepass');
Route::get('/export', 'adminwork@export')->name('export');
Route::post('/import', 'adminwork@import')->name('import');
