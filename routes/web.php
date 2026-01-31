<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\ConfigerController; // used
use App\Http\Controllers\ProductController; // used
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\ConsultantAssessmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sms\EmailController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudylevelController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Sms\SmsController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ConsultantsQualificationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ConsultantServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentChoiceController;
use App\Http\Controllers\StudentConsultantsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostQuotationController;
use App\Http\Controllers\EducationalInfoController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TrainingsInfoController;
use App\Http\Controllers\FilterPageController;
use App\Http\Controllers\ProConsultantController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AgencyAccountController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\StudentPostController;
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
// _________ this route for linking local storage on liver server
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});
// _________ this route for cut link storage on liver server
Route::get('/unlinkstorage', function () {
    $link = public_path('storage');
    if (is_link($link)) {
        // If it's a symlink → remove it
        unlink($link);
        return 'Storage symlink removed successfully!';
    } elseif (is_dir($link)) {
        // If it's a real directory → delete directory
        File::deleteDirectory($link);
        return 'Storage directory removed successfully!';
    }
    return 'No storage link or directory found.';
});

Route::get('otp-verification-email/{email}', [EmailController::class, 'sendEmailUser'])->name('send.emailOTP');
// Route::get('otp-verification/{phone}', [SmsController::class, 'sendSmsUser'])->name('send.otp');
Route::get('otp-verify', [SmsController::class, 'index'])->name('otp.verify');
Route::post('otp-send', [SmsController::class, 'store'])->name('otp.store');

Route::get('otp-resend', [SmsController::class, 'resend'])->name('otp.resend');

// _____________________ for changing language (Page Translation)
// Route::get('language/{locale}', function ($locale) {
//     app()->setLocale($locale);
//     session()->put('locale', $locale);
//     return redirect()->back();
// });
// This is for name route
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
// _____________________ for changing language (Page Translation)

Route::get('/', [HomePageController::class, 'index'])->name('home'); // used
Route::get('about', [AboutPageController::class, 'index'])->name('about');
Route::get('contact', [ContactPageController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contactUs');
Route::get('/eduwise-terms-and-condition', [HomePageController::class, 'termsCondition'])->name('terms.condition');


Route::get('/educational-details-information{id}', [HomePageController::class, 'eduDetailInfo'])->name('eduInfo.detail');

Route::get('/become_pro_consultants', [ProConsultantController::class, 'index'])->name('pro.consultant');

// Search keyword
Route::get('your-search-result', [SearchController::class, 'index'])->name('search.keyword');
// Search Consultants
Route::get('your-consultants-search-result', [SearchController::class, 'consultantsSearch'])->name('search.consultants');
// Filter page
Route::match(['get', 'post'], '/your-selected-result', [FilterPageController::class, 'index'])->name('filter');
// filter.course
Route::get('your-selected-result-courses', [FilterPageController::class, 'filterCourse'])->name('filter.course');
// filter.scholarship
Route::get('your-selected-result-scholarship', [FilterPageController::class, 'filterScholarship'])->name('filter.scholarship');
// filter.universities
Route::get('your-selected-result-university', [FilterPageController::class, 'filterUniversity'])->name('filter.universities');
// filter.Budget
Route::get('your-selected-result-Budget', [FilterPageController::class, 'filterBudget'])->name('filter.budget');

// consultants details - public
Route::get('/consultants-profile-details-view/{id}', [HomePageController::class, 'consultantProfileDetails'])->name('consultant.profile.public');

// consultants - public
Route::get('/consultants', [HomePageController::class, 'consultantsPage'])->name('ediwise.consultants');
// service wise cosultants page
Route::get('search-consultant-service', [HomePageController::class, 'servicewiseConsultants'])->name('servicewise.consultants');
Route::get('search-consultant-country', [HomePageController::class, 'countrywiseConsultants']);



// Course Order
Route::get('/courses', [OrderController::class, 'index'])->name('order.index');
Route::get('/courses/foreign-Education-and-Study-abroad-Student-Consultancy-Training', [OrderController::class, 'orderPlace'])->name('order.place');
Route::post('course/order', [OrderController::class, 'paymentInitial'])->name('order.store');

// course details
Route::get('course/details/{id}', [CourseEnrollController::class, 'details'])->name('course.details');
Route::get('course/checkout/{id}', [CourseEnrollController::class, 'courseCeckout'])->name('course.checkout');
// course order payment
Route::post('course/checkout/payment', [CourseEnrollController::class, 'payment'])->name('course.payment');

// success and cancel route
Route::get('course/payment/success/', [CourseEnrollController::class, 'success'])->name('payment.success');
Route::get('course/payment/cancel/', [CourseEnrollController::class, 'cancel'])->name('payment.cancel');


// SMS
Route::get('/send-sms-new-user',[SmsController::class,'sendSmsNewCustomer'])->name('sendSmsNewCustomer');
Route::get('/order-confirem-sms',[SmsController::class,'orderConfirmedSms'])->name('orderConfirmedSms');

// pro subscriptions
Route::get('pro-consultants-subscription{id}', [ProConsultantController::class, 'subscription'])->name('pro.subscription');
Route::post('pro-consultants-subscription-registration', [ProConsultantController::class, 'takingSubscription'])->name('taking.subscription');

// pro consultants success and cancel route
Route::get('pro-consultants-payment-success', [ProConsultantController::class, 'success'])->name('pro.payment.success');
Route::get('pro-consultants-payment-cancel', [ProConsultantController::class, 'cancel'])->name('pro.payment.cancel');


# Social Login
// Route::get('/auth/redirect/{provider}', [SocialLoginController::class, 'login'])->name(('social.login'));
// Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');


// study abroad form
Route::get('/study-abroad-query', [HomePageController::class, 'studyAbroadForm'])->name('ediwise.studyabroad.form');
Route::post('/study-abroad-query-store', [HomePageController::class, 'studentQueryStore'])->name('student.query.store');

// Student Post
Route::get('/student-post', [StudentPostController::class, 'studentPost'])->name('student.post.feed');
Route::get('student-post-filter/{type}/{value}', [StudentPostController::class, 'postFilter'])->name('post.filter');



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
    
    Route::resource('configer', ConfigerController::class); // used
    Route::resource('product', ProductController::class); // used
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('productDelete');
    Route::post('product-search', [ProductController::class, 'search'])->name('productSearch');

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
    Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('dashbaord.language.switch');

    // Dashboard
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');

    // Action butttons route
    Route::get('/student/{action}', [UserDashboardController::class, 'dashboardAction'])->name('student.profile.action');

    // Consultants (services)
    Route::get('/consultant-services-create', [ConsultantServiceController::class, 'consultantServicesCrate'])->name('consultant.service.create');
    Route::get('/consultant-services-form/{action?}', [ConsultantServiceController::class, 'consultantServicesFrom'])->name('consultant.services');
    Route::match(['get', 'post'], '/consultant-services-add-form', [ConsultantServiceController::class, 'servicesAdd'])->name('consultant.service.add');
    Route::get('/consultant-services-deleted/{id}', [ConsultantServiceController::class, 'consultantServicesDelete'])->name('consultant.service.delete');
    Route::get('/consultant-services-edit/{id}', [ConsultantServiceController::class, 'consultantServicesEdit'])->name('consultant.services.edit');
    Route::get('/consultant-service-disable/{id}', [ConsultantServiceController::class, 'consultantServicesDisable'])->name('consultant.service.disbable');
    Route::get('/consultant-service-enable/{id}', [ConsultantServiceController::class, 'consultantServicesEnable'])->name('consultant.service.enable');
    Route::get('/consultant-services-update/{id}', [ConsultantServiceController::class, 'consultantServicesUpdateform'])->name('consultant.service.update_get');
    Route::put('/consultant-service/update/{id}', [ConsultantServiceController::class, 'consultantServicesUpdate'])->name('consultant.service.update');

    // Consultants (Qualification)
    Route::get('/consultant-qualifications', [QualificationController::class, 'qualifications'])->name('consultant.qualification');
    Route::match(['get', 'post'], '/consultant-qualification-form', [QualificationController::class, 'qualification_form'])->name('consultant.qualification.add');
    Route::get('/consultant-qualification-form-edit/{id}', [QualificationController::class, 'qualification_edit'])->name('consultant.qualification.edit');
    Route::post('/consultant-qualification-form-update', [QualificationController::class, 'qualification_update'])->name('consultant.qualification.update');
    Route::get('/consultant-qualifications-deleted/{id}', [QualificationController::class, 'qualificationsDelete'])->name('consultant.qualification.detete');
    
    // Consultants (Verify Request)
    Route::get('/consultant-verify-request', [ProfileController::class, 'verifyRequest'])->name('consultant.verify.request');

    // Consultants (Education)
    Route::get('/consultant-Education-create', [ConsultantsQualificationController::class, 'create'])->name('consultant.education.create');
    Route::get('/consultant-Education-update/{id}', [ConsultantsQualificationController::class, 'update'])->name('consultant.education.updateForm');
    Route::match(['get', 'post'], '/consultant-Education', [ConsultantsQualificationController::class, 'index'])->name('consultant.education');
    Route::post('/consultant-education-edit', [ConsultantsQualificationController::class, 'dataUpdate'])->name('consultant.education.update');
    Route::get('/consultant-education-delete/{id}', [ConsultantsQualificationController::class, 'dataDelete'])->name('consultant.education.delete');

    // Consultants (Experience)
    Route::get('/consultant-experience', [ExperienceController::class, 'experiences'])->name('consultant.experience');
    Route::match(['get', 'post'], '/consultant-experience-form', [ExperienceController::class, 'experience_form'])->name('consultant.experience.add');
    Route::get('/consultant-experience-form-edit/{id}', [ExperienceController::class, 'experience_edit'])->name('consultant.experience.edit');
    Route::post('/consultant-experience-form-update', [ExperienceController::class, 'experience_update'])->name('consultant.experience.update');
    Route::get('/consultant-experiences-deleted/{id}', [ExperienceController::class, 'experiencesDelete'])->name('consultant.experience.detete');

    // Consultants (Trainings)
    Route::get('/consultant-trainings', [TrainingController::class, 'trainings'])->name('my.trainings');
    Route::match(['get', 'post'], '/consultant-trainings-form', [TrainingController::class, 'trainingsform'])->name('consultant.trainings.add');
    Route::get('/consultant-trainings-form-edit/{id}', [TrainingController::class, 'trainingsEdit'])->name('consultant.trainings.edit');
    Route::post('/consultant-trainings-form-update', [TrainingController::class, 'trainingsUpdate'])->name('consultant.trainings.update');
    Route::get('/consultant-trainings-deleted/{id}', [TrainingController::class, 'trainingsDelete'])->name('consultant.trainings.detete');

    // Consultants (Request)
    // Pending request
    Route::get('/consultant-pending-request', [RequestController::class, 'pendingRequest'])->name('consultant.request.pending');

    // STUDENT (Qualification / Academic Info)


    Route::post('/student-last-education-store', [StudentInfoController::class, 'studentLastEducationStore'])->name('student.lastEducation');
    Route::post('/student-last-education-certification-information', [StudentInfoController::class, 'studentLastEduDoc'])->name('student.lastEdu.doc');
    Route::get('/student-last-education-Delete-information', [StudentInfoController::class, 'studentLastEduDelete'])->name('student.lastEdu.delete');
    Route::match(['get', 'post'], '/student-info-form', [StudentInfoController::class, 'studentInfoForm'])->name('student.info.add');
    Route::match(['get', 'post'], '/student-choice-form', [StudentChoiceController::class, 'index'])->name('student.choice');
    Route::get('/student-choice-create-form', [StudentChoiceController::class, 'choiceCreateForm'])->name('create.choice.form');
    Route::post('/student-choice-crate', [StudentChoiceController::class, 'choiceCreate'])->name('student.choice.create');
    Route::post('/student-choice-update', [StudentChoiceController::class, 'choiceUpdate'])->name('student.choice.update');
    Route::get('/student-choices-delete/{id}', [StudentChoiceController::class, 'choiceDelete'])->name('choice.delete');
    Route::get('/consultants-of-eduwise/{choice_id?}', [StudentConsultantsController::class, 'index'])->name('consultant.list');


    Route::get('/consultants-profile-details-eduwise/{id}', [StudentConsultantsController::class, 'profileDetails'])->name('consultant.profile');

    // Route::get('/consultant-trainings', [UserDashboardController::class, 'trainings'])->name('consultant.trainings');
    // Route::match(['get', 'post'], '/consultant-trainings-form', [UserDashboardController::class, 'trainingsform'])->name('consultant.trainings.add');
    // Route::get('/consultant-trainings-form-edit/{id}', [UserDashboardController::class, 'trainingsEdit'])->name('consultant.trainings.edit');
    // Route::post('/consultant-trainings-form-update', [UserDashboardController::class, 'trainingsUpdate'])->name('consultant.trainings.update');
    // Route::get('/consultant-trainings-deleted/{id}', [UserDashboardController::class, 'trainingsDelete'])->name('consultant.trainings.detete');

    // ________________________ assessment request
    Route::match(['get','post'], '/student-assessment-request-consultant/{service_id}/{choice_id?}', [AssessmentController::class, 'AssessmentRequest'])->name('assessment.requesting');
    Route::post('/student-assessment-request-send', [AssessmentController::class, 'AssessmentRequestStore'])->name('assessment.request.store');

    Route::get('/student-assessment-request/{service_id}/{choice_id?}', [AssessmentController::class, 'singleServiceRequest'])->name('service.requesting');
    
    // Order
    Route::get('/order', [UserDashboardController::class, 'showAllOrder'])->name('dashboard.order');

    // Class Schedule
    Route::get('/schedule', [ClassScheduleController::class, 'getClassSchdule'])->name('schedule.index');

    // Profile Update
    Route::get('/profile/edit', [UserDashboardController::class, 'profileEdit'])->name('profile.edit');
    Route::patch('/profile/update/information', [UserDashboardController::class, 'updateInformation'])->name('profile.update.information');
    Route::patch('/profile/update/password', [UserDashboardController::class, 'updatePassword'])->name('profile.update.password');
    Route::patch('/profile/update/image', [UserDashboardController::class, 'updateImage'])->name('profile.update.image');
    Route::post('/update-profile-image', [UserDashboardController::class, 'updateImage'])->name('update.profile.image');


    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Assessment Fee Setup
    Route::get('/consultant/assessment/fee-setup', [AssessmentController::class, 'assessmentFeeSetup'])->name('consultant.assessment.assessment-fee-setup');
    Route::patch('/consultant/assessment/fee-setup', [AssessmentController::class, 'assessmentFeeSetupUpdate'])->name('consultant.assessment.assessment-fee-setup-update');

    // Assessment Student
    Route::get('/student/assessment', [AssessmentController::class, 'index'])->name('student.assessment.index');
    Route::get('/student/assessment/request', [AssessmentController::class, 'allRequest'])->name('student.assessment.all-request');
    Route::get('/student-assessment-request-filter', [AssessmentController::class, 'filterRequest'])->name('student.assessment.filter');
    Route::get('/student/assessment/draft', [AssessmentController::class, 'draftAssessment'])->name('student.assessment.draft');
    Route::get('/student/assessment/create', [AssessmentController::class, 'create'])->name('student.assessment.create');
    Route::get('/student/assessment/create/consultant-select', [AssessmentController::class, 'ConsultantSelect'])->name('student.assessment.consultant-select');
    Route::get('/consultant/details', [AssessmentController::class, 'getConsultantDetails'])->name('consultant.details');
    Route::get('/student/assessment/{user}/send-request', [AssessmentController::class, 'AssessmentRequest'])->name('student.assessment.send-request');
    Route::post('/student/assessment/send-request', [AssessmentController::class, 'AssessmentRequestStore'])->name('student.assessment.store-request');
    Route::delete('/student/assessment/{assessment}destroy', [AssessmentController::class, 'destroy'])->name('student.assessment.destroy');

    // Assessment Consultant
    Route::get('/consultant/assessment/request/{status}', [ConsultantAssessmentController::class, 'allRequest'])->name('consultant.assessment.all-request');
    Route::get('/consultant/assessment/request/{assessment}/details', [ConsultantAssessmentController::class, 'requestDetails'])->name('consultant.assessment.details');
    Route::post('/consultant/assessment/request/status', [ConsultantAssessmentController::class, 'statusUpdate'])->name('consultant.assessment.status');

    // Assessment Report
    Route::get('/consultant/assessment/{assessment}/report', [ConsultantAssessmentController::class, 'createReport'])->name('consultant.assessment.report.create');

    // Mark as Done
    Route::get('/consultant-assessment-submission-{assessment_id}', [ConsultantAssessmentController::class, 'submittedTask'])->name('consultant.assessment.submitted');

    // Full Assessment Report Download
    Route::get('/consultant/assessment/{assessment}/report/download', [ConsultantAssessmentController::class, 'downloadReport'])->name('consultant.assessment.report.download');
    // Full Assessment Report Download
    Route::get('/dashboard/consultant/assessment/{assessment}/report/view', [ConsultantAssessmentController::class, 'viewReport'])
    ->name('consultant.assessment.report.view');

    // Assessment Report: Recommended Universities Routes
    Route::post('/consultant/assessment/{assessment}/university', [ConsultantAssessmentController::class, 'storeUniversity'])->name('consultant.assessment.university.store');
    Route::put('/consultant/assessment/{assessment}/university/{university}', [ConsultantAssessmentController::class, 'updateUniversity'])->name('consultant.assessment.university.update');
    Route::delete('/consultant/assessment/{assessment}/university/{university}', [ConsultantAssessmentController::class, 'destroyUniversity'])->name('consultant.assessment.university.destroy');

    // Assessment Report: Other Assessments Routes
    Route::post('/consultant/assessment/{assessment}/report/store', [ConsultantAssessmentController::class, 'storeOrUpdateReport'])->name('consultant.report.update');
    Route::post('/consultant/assessment/{assessment}/report/submit', [ConsultantAssessmentController::class, 'submitReport'])->name('consultant.report.submit');

    // Consultants Report)
    Route::post('/consultant-report-store', [RequestController::class, 'pendingRequest'])->name('consultant.report.store');

    // Student Review of the assessment task
    Route::get('/assessment/request/submit-reviews/{assessment_id}/{consultant_id}', [AssessmentController::class, 'reviewCreate'])->name('reviews.create');
    Route::post('/submit-reviews', [AssessmentController::class, 'reviewStore'])->name('reviews.store');
    
    // Report or Accept of a service
    Route::match(['get','post'],'/service/report/submit/{service_id}', [AssessmentController::class, 'serviceReport'])->name('report.service');
    Route::get('/service-acceptance/{service_id}', [AssessmentController::class, 'serviceAccept'])->name('service.accept');

    // Balance
    Route::get('/student-transaction', [TransactionController::class, 'cashInStudent'])->name('student.cashin');
    Route::get('/consultant-transaction', [TransactionController::class, 'cashInConsultant'])->name('consultant.transaction.details');
    Route::get('/consultant/transaction/history', [TransactionController::class, 'transactionHistory'])->name('consultant.transaction.history');
    Route::post('/consultant/transaction/set-method', [TransactionController::class, 'setTransactionMethod'])->name('consultant.transaction.set-method');
    Route::get('/consultant/account/details', [TransactionController::class, 'getAccountDetails'])->name('consultant.account.details');
    Route::post('/consultant/transaction/withdrawal/store', [TransactionController::class, 'storeWithdrawalRequest'])->name('consultant.transaction.withdrawal.store');

    Route::get('/consultant/reviews', [ConsultantServiceController::class, 'consultantReviews'])->name('consultant.reviews');

    Route::post('/student/transaction', [TransactionController::class, 'paymentInitial'])->name('student.transaction.store');
    Route::get('/student/transaction/success', [TransactionController::class, 'success'])->name('student.transaction.payment.success');
    Route::get('/student/transaction/cancel', [TransactionController::class, 'cancel'])->name('student.transaction.payment.cancel');
    
    // Student Post
    Route::get('/student-post', [StudentPostController::class, 'index'])->name('student.post');
    Route::match(['get', 'post'], '/student-post-create', [StudentPostController::class, 'create'])->name('student.post.create');
    Route::get('/student-post-enabled/{id}', [StudentPostController::class, 'StudentPostEnabled'])->name('student.post.enabled');
    Route::get('/student-post-disabled/{id}', [StudentPostController::class, 'StudentPostDisabled'])->name('student.post.disabled');
    Route::get('/student-post-delete/{id}', [StudentPostController::class, 'StudentPostDelete'])->name('student.post.delete');
    Route::match(['get', 'post'], '/post-update/{id}', [StudentPostController::class, 'StudentPostUpdate'])->name('student.post.update');

    // Quotation - (consultants)
    Route::get('/student-post-service-selection/{post_id}/{country}', [StudentPostController::class, 'postServiceSelection'])->name('post.quote.service');
    Route::post('/send-quote', [StudentPostController::class, 'SendQuote'])->name('student.sendQuote');
    
    // Quotation - (student)
    Route::get('/consultant-quotation/{post_id}/{country_id}', [PostQuotationController::class, 'index'])->name('view.quotation');

    // _______ AGENCY
    Route::post('/upload-agency-banner', [AgencyAccountController::class, 'updateAgencyBanner'])->name('agency.banner');
    Route::get('/agency-galary', [AgencyAccountController::class, 'AgencyGalary'])->name('agency.galary');
    Route::get('/agency-consultants', [AgencyAccountController::class, 'AgencyConsultants'])->name('agency.consultant');
    Route::get('/agency-consultants-create', [AgencyAccountController::class, 'AgencyConsultantsCreate'])->name('agency.consultant.create');
    Route::post('/agency-consultants-store', [AgencyAccountController::class, 'AgencyConsultantsStore'])->name('agency.consultant.store');
    Route::get('/agency-consultants-update/{id}', [AgencyAccountController::class, 'AgencyConsultantsEdit'])->name('agency.consultant.edit');
    Route::put('/agency/consultant/{id}', [AgencyAccountController::class, 'AgencyConsultantsUpdate'])->name('agency.consultant.update');

    Route::get('/agency-services', [AgencyAccountController::class, 'AgencyServices'])->name('agency.services');
    Route::get('/agency-services-create', [AgencyAccountController::class, 'AgencyServiceCreate'])->name('agency.service.create');
    Route::post('/agency-services-store',[AgencyAccountController::class, 'AgencyServiceStore'])->name('agency.services.store');
    Route::match(['get', 'post'], '/agency-services-update/{id}', [AgencyAccountController::class, 'AgencyServiceUpdate'])->name('agency.services.update');
    Route::get('/agency-services-enabled/{id}', [AgencyAccountController::class, 'AgencyServiceEnabled'])->name('agency.services.enabled');
    Route::get('/agency-services-disabled/{id}', [AgencyAccountController::class, 'AgencyServiceDisabled'])->name('agency.services.disabled');
    Route::get('/agency-services-delete/{id}', [AgencyAccountController::class, 'AgencyServiceDelete'])->name('agency.services.delete');
    
    // agency country
    Route::get('/agency-country', [AgencyAccountController::class, 'AgencyCountry'])->name('agency.country');
    Route::get('/agency-country-create', [AgencyAccountController::class, 'AgencyCountryCreate'])->name('agency.country.create');
    Route::post('/agency-country-store', [AgencyAccountController::class, 'AgencyCountryStore'])->name('agency.country.store');
    Route::match(['get', 'post'], '/agency-country-update/{id}', [AgencyAccountController::class, 'AgencyCountryUpdate'])->name('agency.country.update');
    Route::get('/agency-country-enabled/{id}', [AgencyAccountController::class, 'AgencyCountryEnabled'])->name('agency.country.enabled');
    Route::get('/agency-country-disabled/{id}', [AgencyAccountController::class, 'AgencyCountryDisabled'])->name('agency.country.disabled');
    Route::get('/agency-country-delete/{id}', [AgencyAccountController::class, 'AgencyCountryDelete'])->name('agency.country.delete');

    Route::get('/agency-galary', [AgencyAccountController::class, 'AgencyGalary'])->name('agency.galary');
    Route::post('/agency-galary-store', [AgencyAccountController::class, 'AgencyGalaryUpload'])->name('agency.gallery.upload');
    Route::get('/agency-delete-gallery/{id}', [AgencyAccountController::class, 'AgencyGalaryDelete'])->name('agency.gallery.delete');

    // agency profile
    Route::get('/agency-profile', [AgencyAccountController::class, 'AgencyProfile'])->name('agency.profile');
    Route::post('/agency-profile-update/{id}', [AgencyAccountController::class, 'AgencyProfileUpdate'])->name('agency.profile.update');
    Route::post('/agency-info-update', [AgencyAccountController::class, 'AgencyInfoUpdate'])->name('agency.info.update');
    Route::match(['get', 'post'], '/agency-profile-other/{id?}', [AgencyAccountController::class, 'AgencyOthersProfile'])->name('agency.info.others');
    
    // agency transaction
    Route::get('/agency-transaction', [AgencyAccountController::class, 'AgencyTransaction'])->name('agency.transaction');
    Route::get('/earnings/country/{name}', [AgencyAccountController::class, 'earningsFilterKeyword'])->name('earnings.filter.keyword');
    Route::get('/earnings/consultant/{name}', [AgencyAccountController::class, 'searchConsultant'])->name('earnings.filter.consultant');
    
    
});




require __DIR__.'/auth.php';
