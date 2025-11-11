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
Route::get('otp-verification-email/{email}', [EmailController::class, 'sendEmailUser'])->name('send.emailOTP');
// Route::get('otp-verification/{phone}', [SmsController::class, 'sendSmsUser'])->name('send.otp');
Route::get('otp-verify', [SmsController::class, 'index'])->name('otp.verify');
Route::post('otp-send', [SmsController::class, 'store'])->name('otp.store');

Route::get('otp-resend', [SmsController::class, 'resend'])->name('otp.resend');

// _____________________ for changing language (Page Translation)
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/', [HomePageController::class, 'index'])->name('home');



Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        $data = [];
    // Fetch Contact data
    $contacts = Contact::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as count')
    )
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    $contactData = array_fill(0, 12, 0); // Array to hold counts for each month
    foreach ($contacts as $contact) {
        $contactData[$contact->month - 1] = $contact->count; // Subtract 1 because months are 1-12, array is 0-indexed
    }

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

    // page content
    Route::post('/page-content-update', [EducationalInfoController::class, 'pageContentUpdate'])->name('pageContent.update');
    // why this country
    Route::post('/why-this-country-create', [EducationalInfoController::class, 'whyThisCountryCreate'])->name('whyThisCountry.create');
    Route::post('/why-this-country-update', [EducationalInfoController::class, 'whyThisCountryUpdate'])->name('whyThisCountry.update');
    Route::get('/why-this-country-delete/{id}', [EducationalInfoController::class, 'whyThisCountryDelete'])->name('whyThisCountry.delete');
    // programs & duration
    Route::post('/programs-duration-create', [EducationalInfoController::class, 'programsDurationCreate'])->name('programsDuration.create');
    Route::post('/programs-duration-update', [EducationalInfoController::class, 'programsDurationUpdate'])->name('programsDuration.update');
    // top-universities
    Route::post('/top-universities-create', [EducationalInfoController::class, 'topUniversitiesCreate'])->name('topUniversities.create');
    Route::post('/top-universities-update', [EducationalInfoController::class, 'topUniversitiesUpdate'])->name('topUniversities.update');
    Route::get('/top-universities-delete/{id}', [EducationalInfoController::class, 'topUniversitiesDelete'])->name('topUniversities.delete');
    // visa checklist
    Route::post('/visa-checklist-create', [EducationalInfoController::class, 'visaChecklistCreate'])->name('checklist.create');
    Route::post('/visa-checklist-update', [EducationalInfoController::class, 'visaChecklistUpdate'])->name('checklist.update');
    Route::get('/visa-checklist-delete/{id}', [EducationalInfoController::class, 'visaChecklistDelete'])->name('checklist.delete');
    // country F.A.Q
    Route::post('/country-faq-create', [EducationalInfoController::class, 'countryFaqCreate'])->name('countryFaq.create');
    Route::post('/country-faq-update', [EducationalInfoController::class, 'countryFaqUpdate'])->name('countryFaq.update');
    Route::get('/country-faq-delete/{id}', [EducationalInfoController::class, 'countryFaqDelete'])->name('countryFaq.delete');
    // country Scholarships
    Route::post('/country-scholarships-create', [EducationalInfoController::class, 'scholarshipsCreate'])->name('scholarships.create');
    Route::post('/country-scholarships-update', [EducationalInfoController::class, 'scholarshipsUpdate'])->name('scholarships.update');
    Route::get('/country-scholarships-delete/{id}', [EducationalInfoController::class, 'scholarshipsDelete'])->name('scholarships.delete');

    // _______ ProUser Packages | admin
    Route::get('/pro-user-package', [PackageController::class, 'index'])->name('proUser.packages');
    Route::get('/pro-user-package-create', [PackageController::class, 'create'])->name('userPackages.create');
    Route::post('/pro-user-package-store', [PackageController::class, 'store'])->name('userPackages.store');
    Route::get('/pro-user-package-update/{id}', [PackageController::class, 'update'])->name('userPackages.update');
    Route::post('/pro-user-package-storeUpdate', [PackageController::class, 'storeUpdate'])->name('userPackages.storeUpdate');
    Route::get('/pro-user-package-disabled/{id}', [PackageController::class, 'disabled'])->name('userPackages.disabled');
    Route::get('/pro-user-package-enabled/{id}', [PackageController::class, 'enabled'])->name('userPackages.enabled');
    
    // _______ Verified User | admin
    Route::get('/verified-user-request', [ProfileController::class, 'index'])->name('verified.user');
    Route::get('/admin/verification/update-status/{status}/{orderId}/{user_id}', 
        [ProfileController::class, 'updateVerificationStatus'])
        ->name('verification.updateStatus');
    
    // _______ Student Queries | admin
    Route::get('/student-queries', [StudentController::class, 'index'])->name('student.query');

    // _______ Service Charge | admin
    Route::get('/user-service-charge', [AdminTransactionController::class, 'index'])->name('user.serviceCharge');
    Route::get('/add-service-charge', [AdminTransactionController::class, 'addCharge'])->name('add.charge');
    Route::post('/store-service-charge', [AdminTransactionController::class, 'storeServiceCharge'])->name('serviceCharge.store');
    Route::get('/delete-charge/{id}', [AdminTransactionController::class, 'deleteCharge'])->name('admin.delete.charge');
    
    // _______ Training Info | admin
    Route::resource('/trianingInfo', TrainingsInfoController::class);
    Route::get('/trianingInfo-status-active/{id}', [TrainingsInfoController::class, 'statusActive'])->name('trianingInfo.active');
    Route::get('/trianingInfo-status-disable/{id}', [TrainingsInfoController::class, 'statusDisable'])->name('trianingInfo.disable');
    Route::match(['get', 'post'], '/trianings-info-update/{id}', [TrainingsInfoController::class, 'TrainingInfoUpdate'])->name('existTrainingInfo.update');
    Route::get('/trianingInfo-deleted/{id}', [TrainingsInfoController::class, 'destroy'])->name('trianingInfo.delete');

    // _______ services | admin start
    Route::resource('/services', ServicesController::class);
    Route::get('/service/{id}', [ServicesController::class, 'destroy'])->name('services.delete');
    Route::match(['get', 'post'],'/service/update/{id}', [ServicesController::class, 'serviceUpdate'])->name('adminService.update');

    // _______ country | admin
    Route::resource('/country', CountryController::class);
    Route::get('/country-status-active/{id}', [CountryController::class, 'statusActive'])->name('country.active');
    Route::get('/country-status-disable/{id}', [CountryController::class, 'statusDisable'])->name('country.disable');
    Route::get('/country-deleted/{id}', [CountryController::class, 'destroy'])->name('country.delete');

    Route::get('/admin/country/search', [CountryController::class, 'search'])->name('country.search');
    Route::post('/admin/country/filter', [CountryController::class, 'filter'])->name('country.filter');

    Route::post('/admin/country/image-select', [CountryController::class, 'imageSelect'])->name('country.imageSelect');




    // _______ course | admin
    Route::resource('/course', CourseController::class);
    Route::get('/course-status-active/{id}', [CourseController::class, 'statusActive'])->name('course.active');
    Route::get('/course-status-disable/{id}', [CourseController::class, 'statusDisable'])->name('course.disable');
    Route::get('/course-deleted/{id}', [CourseController::class, 'destroy'])->name('course.delete');

    // _______ university | admin
    Route::resource('/university', UniversityController::class);
    Route::get('/university-status-active/{id}', [UniversityController::class, 'statusActive'])->name('university.active');
    Route::get('/university-status-disable/{id}', [UniversityController::class, 'statusDisable'])->name('university.disable');
    Route::get('/university-deleted/{id}', [UniversityController::class, 'destroy'])->name('university.delete');
    
    // _______ testimonials | admin
    Route::resource('/testimonials', TestimonialsController::class);
    Route::match(['get', 'post'],'/create/store/testimonials', [TestimonialsController::class,'createTestimonial'])->name('testimonials.add');
    Route::get('/delete/testimonials/{id}', [TestimonialsController::class,'deleteTestimonial'])->name('testimonials.delete');
    
    // _______ F.A.Q | admin
    Route::match(['get', 'post'],'/create/store/faq', [FaqController::class,'index'])->name('faq.index');
    Route::post('/faq/update', [FaqController::class, 'update'])->name('faq.update');
    Route::get('admin/faq/delete/{id}', [FaqController::class, 'destroy'])->name('faq.delete');


    // _______ Studylevel | admin
    Route::resource('/studylevel', StudylevelController::class);
    Route::get('/studylevel-status-active/{id}', [StudylevelController::class, 'statusActive'])->name('studylevel.active');
    Route::get('/studylevel-status-disable/{id}', [StudylevelController::class, 'statusDisable'])->name('studylevel.disable');
    Route::get('/studylevel-deleted/{id}', [StudylevelController::class, 'destroy'])->name('studylevel.delete');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/information', [ProfileController::class, 'updateInformation'])->name('profile.update.information');
    Route::patch('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::patch('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/user', AdminController::class);

    Route::resource('slider', SliderController::class);
    Route::resource('about', AboutController::class);

    Route::get('/company-details', [AboutController::class, 'companyDetails'])->name('companyDetails');
    Route::get('/company-details-view/{companyDetail}', [AboutController::class, 'companyView'])->name('companyView');
    Route::put('/company-details-update/{companyDetail}', [AboutController::class, 'companyUpdate'])->name('companyUpdate');

    Route::get('/contact', [ContactController::class, 'index'])->name('contactContent');
    Route::get('/contact/show/{id}', [ContactController::class, 'show'])->name('contactShow');
    Route::delete('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contactDelete');

    Route::resource('configer', ConfigerController::class);

    // Orders
    Route::get('/order', [OrderController::class, 'getAllOrder'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order-details/{order}/details', [OrderController::class, 'details'])->name('order.details');
    Route::get('/order-details/{order}/DownloadOrderPDF', [OrderController::class, 'DownloadOrderPDF'])->name('order.DownloadOrderPDF');
    Route::put('/order-details/{order}/paymentStatus', [OrderController::class, 'paymentStatus'])->name('order.paymentStatus');
    Route::put('/order-details/{order}/orderStatus', [OrderController::class, 'orderStatus'])->name('order.orderStatus');

    // Class Schedule
    Route::get('/schedule', [ClassScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ClassScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/schedule/{id}/update-status', [ClassScheduleController::class, 'updateStatus'])->name('schedule.updateStatus');
    Route::put('/schedule/{schedule}', [ClassScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}/delete', [ClassScheduleController::class, 'destroy'])->name('schedule.destroy');

    // terms & condition
    Route::get('/terms-and-condition', [TermsConditionController::class, 'index'])->name('termscondition.index');
    Route::post('/store-terms-and-condition', [TermsConditionController::class, 'store'])->name('terms.store');
    Route::post('/terms/update/{id}', [TermsConditionController::class, 'update'])->name('terms.update');
    Route::get('/terms/delete/{id}', [TermsConditionController::class, 'destroy'])->name('terms.delete');

});


Route::prefix('dashboard')->middleware('auth:web')->group(function () {
    // Dashboard

});



require __DIR__.'/auth.php';
