<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Sms\EmailController;
use App\Http\Controllers\Sms\SmsController;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('otp-verification-email/{email}', [EmailController::class, 'sendEmailUser'])->name('send.emailOTP');
// Route::get('otp-verification/{phone}', [SmsController::class, 'sendSmsUser'])->name('send.otp');
// Route::get('otp-verify', [SmsController::class, 'index'])->name('otp.verify');
// Route::post('otp-send', [SmsController::class, 'store'])->name('otp.store');

// Route::get('otp-resend', [SmsController::class, 'resend'])->name('otp.resend');

// _____________________ for changing language (Page Translation)
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about-us', [HomePageController::class, 'about'])->name('about');


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
   

    $data['contactData'] = $contactData;
        return view('Backend.Pages.dashboard', $data);
    })->middleware(['auth', 'verified'])->name('dashboard');


    // _______ Educational Info | admin
    Route::resource('/eduinfo', EducationalInfoController::class);
    Route::get('/eduifno-status-active/{id}', [EducationalInfoController::class, 'statusActive'])->name('existInfo.active');
    Route::get('/eduifno-status-disable/{id}', [EducationalInfoController::class, 'statusDisable'])->name('existInfo.disable');
    Route::get('/eduifno-home-status-active/{id}', [EducationalInfoController::class, 'homeStatusActive'])->name('existInfo.homeActive');
    Route::get('/eduifno-home-status-disable/{id}', [EducationalInfoController::class, 'homeStatusDisable'])->name('existInfo.homeDisable');
    Route::match(['get', 'post'], '/educationinfo-update/{id}', [EducationalInfoController::class, 'infoUpdate'])->name('existInfo.update');
    Route::get('/eduinfo-deleted/{id}', [EducationalInfoController::class, 'destroy'])->name('eduinfo.delete');


});


Route::prefix('dashboard')->middleware('auth:web')->group(function () {
    // Dashboard

});



require __DIR__.'/auth.php';
