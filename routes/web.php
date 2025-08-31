<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;


Route::get('faq/{id}', function ($id) {
    // إيجاد السؤال الحالي أو عرض خطأ 404 إذا لم يوجد
    $currentFaq = Faq::where('status', 1)->findOrFail($id);

    // إيجاد السؤال التالي:
    // ابحث عن أول سؤال نشط بمعرّف أكبر من المعرّف الحالي
    $nextFaq = Faq::where('status', 1)
        ->where('id', '>', $currentFaq->id)
        ->orderBy('id', 'asc')
        ->first();

    // إيجاد السؤال السابق:
    // ابحث عن آخر سؤال نشط بمعرّف أصغر من المعرّف الحالي
    $prevFaq = Faq::where('status', 1)
        ->where('id', '<', $currentFaq->id)
        ->orderBy('id', 'desc')
        ->first();

    // إرسال السؤال الحالي، والسؤال التالي والسابق (إذا وُجدا) إلى الـ view
    return view('faq', [
        'faq' => $currentFaq,
        'nextFaqId' => $nextFaq ? $nextFaq->id : null,
        'prevFaqId' => $prevFaq ? $prevFaq->id : null,
    ]);
})->name('faq.show');
// Route::get('faq/{id}', function ($id) {
//     $faq = Faq::where('status', 1)->findOrFail($id);
//     return view('faq_single', compact('faq'));
// })->name('faq.single');

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
