<?php

// Facades
use Illuminate\Support\Facades\{
    Artisan,
    Auth,
    Route
};

use App\Http\Controllers\Auth\{
    AuthController
};


// Shared Restful Controllers
use App\Http\Controllers\All\{
    ProfileController,
    TmpImageUploadController
};

// Admin Restful Controllers
use App\Http\Controllers\Admin\{
    ActivityLogController,
    DashboardController,
    CategoryController,
    GasolineFeeController,
    GasolineStationController,
    ServiceController,
    StaffController,
    UserController
};
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\GasolineFeeController as StaffGasolineFeeController;
use App\Http\Controllers\Staff\GasolineStationController as StaffGasolineStationController;
use App\Http\Controllers\Staff\ServiceController as StaffServiceController;
use App\Http\Controllers\User\GasolineStationController as UserGasolineStationController;
use App\Http\Controllers\User\NearestGasolineStationController;
use App\Http\Controllers\User\RatingController;

Route::get('/', function () {
    return to_route('auth.login');
});

Route::view('/install', 'install')->name('app.install');

// caching
Route::get('/cache', function () {
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return 'cache';
});

// Route::get('/symlink', function () {
//     symlink('/home/u686793928/iskool/storage/app/public', '/home/u686793928/domains/mainsandbox.com/public_html/sub_iskool/storage');
// });



// Admin 
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
    
    Route::resource('users', UserController::class);

    //Route::get('role', RoleController::class)->name('role.index');

    /** Start Gas Station Managment */
        Route::resource('gasoline_stations', GasolineStationController::class);
        Route::resource('gasoline_fees', GasolineFeeController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('staffs', StaffController::class);
    /** End Gas Station Managment */
    
    Route::get('activity_logs', ActivityLogController::class)->name('activity_logs.index');
});


// Staff 
Route::group(['middleware' => ['auth', 'staff'], 'prefix' => 'staff', 'as' => 'staff.'],function() {
    
    Route::get('dashboard', StaffDashboardController::class)->name('dashboard.index');
    Route::get('gasoline_stations', StaffGasolineStationController::class)->name('gasoline_stations.index');


    /** Start Gas Station Managment */
        Route::resource('gasoline_fees', StaffGasolineFeeController::class);
        Route::resource('services', StaffServiceController::class);
    /** End Gas Station Managment */
    
    Route::get('activity_logs', ActivityLogController::class)->name('activity_logs.index');
});


// User 
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user', 'as' => 'user.'],function() {

    Route::view('/privacy-policy', 'user.pages.privacy_policy')->name('pages.privacy_policy');
    Route::view('/about', 'user.pages.about')->name('pages.about');

    Route::resource('gasoline_stations', UserGasolineStationController::class)->only('index', 'show');

    Route::post('/gasoline_stations/{gasoline_station}/ratings', RatingController::class)->name('ratings.store');

    Route::post('/get_nearest_gasoline_stations', NearestGasolineStationController::class)->name('nearest_gasoline_stations.get');

});



// Shared Controller
Route::group(['middleware' => ['auth']],function() {

    // TMP FILE UPLOAD
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);
    Route::post('tmp_upload/content', [TmpImageUploadController::class, 'faqImageUpload'])->name('tmpupload.faqImageUpload');
    Route::resource('tmp_upload', TmpImageUploadController::class);
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');;
  
});

Route::group(['as' => 'auth.', 'controller' => AuthController::class],function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'attemptLogin')->name('attemptLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'attemptRegister')->name('attemptRegister');
    Route::post('/logout', 'logout')->name('logout');


    Route::get('/email/verify/{token}', 'emailVerification')->name('email_verification'); // email verification

});


Auth::routes(['login' => false, 'register' => false, 'logout' => false]);