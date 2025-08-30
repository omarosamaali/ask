<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;

Route::get('faq', function () {
    $faqs = Faq::where('status', 1)->get();
    return view('faq',  compact('faqs'));
})->name('faq');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/members/changepassword', [RegisterControllerUser::class, 'changepassword'])->name('members.changepassword');
Route::get('/members/otp', [RegisterControllerUser::class, 'otp'])->name('members.otp');
Route::get('/members/forgetpassword', [RegisterControllerUser::class, 'forgetpassword'])->name('members.forgetpassword');
Route::post('/members/send-otp', [RegisterControllerUser::class, 'sendOtp'])->name('members.send_otp');
Route::post('/members/verify-otp', [RegisterControllerUser::class, 'verifyOtp'])->name('members.verify_otp');
Route::post('/members/update-password', [RegisterControllerUser::class, 'updatePassword'])->name('members.update_password');
Route::post('/members/logout', function () {
    Auth::logout();
    return redirect()->route('members.login');
})->name('members.logout');

Route::get('/members/membership-show', function () {
    return view('members.sidebar.membership-show');
})->name('members.membership-show');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin_routes.php';
