<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\ConfigerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Storage linking routes
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

Route::get('/unlinkstorage', function () {
    $link = public_path('storage');
    if (is_link($link)) {
        unlink($link);
        return 'Storage symlink removed successfully!';
    } elseif (is_dir($link)) {
        File::deleteDirectory($link);
        return 'Storage directory removed successfully!';
    }
    return 'No storage link or directory found.';
});

// Language switcher
Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language.switch');

// Frontend routes
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about', [HomePageController::class, 'about'])->name('about');
Route::get('/contact', [HomePageController::class, 'contact'])->name('contact');
Route::post('/contact', [HomePageController::class, 'submitContact'])->name('contact.submit');
Route::get('/terms-and-condition', function () {
    return redirect()->route('home');
})->name('terms.condition');
Route::get('/products', [HomePageController::class, 'products'])->name('products');
Route::get('/product/{id}', [HomePageController::class, 'productDetail'])->name('product.detail');
Route::get('/checkout/{id?}', [HomePageController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [HomePageController::class, 'submitCheckout'])->name('checkout.submit');

// User Account & Dashboard routes
Route::get('/dashboard', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->name('dashboard');

Route::get('/user/dashboard', [HomePageController::class, 'account'])->name('user.dashboard');
Route::get('/account', [HomePageController::class, 'account'])->name('account');
Route::post('/account/update', [HomePageController::class, 'updateAccount'])->name('account.update');
Route::post('/account/password', [HomePageController::class, 'updatePassword'])->name('account.password');

// Cart routes
use App\Http\Controllers\CartController;
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/items', [CartController::class, 'getCart'])->name('items');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('/sync', [CartController::class, 'sync'])->name('sync');
});

// Admin routes (Protected by auth:admin guard)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        $data = [];
        $contacts = Contact::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $contactData = array_fill(0, 12, 0);
        foreach ($contacts as $contact) {
            $contactData[$contact->month - 1] = $contact->count;
        }

        $data['contactData'] = $contactData;
        return view('Backend.Pages.dashboard', $data);
    })->name('dashboard');

    Route::post('configer/test-notification', [ConfigerController::class, 'testNotification'])->name('configer.test-notification');
    Route::resource('configer', ConfigerController::class);
    Route::resource('product', ProductController::class);
    Route::post('product/{product}/toggle-hero', [ProductController::class, 'toggleHero'])->name('product.toggleHero');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('productDelete');
    Route::post('product-search', [ProductController::class, 'search'])->name('productSearch');

    // Product Packages Management
    Route::post('products/{product}/packages', [\App\Http\Controllers\Admin\PackageController::class, 'store'])->name('packages.store');
    Route::put('packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'update'])->name('packages.update');
    Route::delete('packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('packages.destroy');
    Route::post('packages/{package}/toggle', [\App\Http\Controllers\Admin\PackageController::class, 'toggle'])->name('packages.toggle');

    // Payment Methods Management
    Route::get('payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment-methods.update');
    Route::post('payment-methods/{id}/toggle', [PaymentMethodController::class, 'toggleStatus'])->name('payment-methods.toggle');

    // Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('show');
        Route::post('/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('destroy');
    });

    // User & Admin Management
    Route::post('user/{id}/toggle-verify', [AdminController::class, 'toggleVerify'])->name('user.toggleVerify');
    Route::resource('user', AdminController::class);

    // Order Taking Settings (Telegram, Discord, Email Notifications)
    Route::prefix('order-taking')->name('order-taking.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\OrderTakingController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Admin\OrderTakingController::class, 'update'])->name('update');
        Route::post('/test', [\App\Http\Controllers\Admin\OrderTakingController::class, 'test'])->name('test');
    });
});

require __DIR__.'/auth.php';
