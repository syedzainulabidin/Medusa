<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ChildController,
    BookingController,
    VaccineController,
    ReportController,
    AdminController,
    HospitalController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| ♦ PUBLIC PAGES  – accessible to everyone
|--------------------------------------------------------------------------
*/

Route::view('/',         'home.index')->name('home');
Route::view('/about',    'home.about')->name('about');
Route::view('/services', 'home.services')->name('services');
Route::view('/contact',  'home.contact')->name('contact');

/*
|--------------------------------------------------------------------------
| ♦ AUTH  – guests only
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // show forms
    Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

    // handle forms
    Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| ♦ LOGGED‑IN  – shared by all roles
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /*
    |----------------------------------------------------------------------
    | ♦ PARENT PORTAL  (role: parent) — URI prefix /parent
    |----------------------------------------------------------------------
    */
    Route::prefix('parent')->middleware('role:parent')->group(function () {

        Route::get('/index', [AuthController::class, 'user'])->name('parent.dashboard');

        // children
        Route::get('/child',       [ChildController::class, 'index'])->name('child.index');
        Route::post('/child',       [ChildController::class, 'store'])->name('child.store');
        Route::put('/child/{id}',  [ChildController::class, 'update'])->name('child.update');
        Route::delete('/child/{id}', [ChildController::class, 'destroy'])->name('child.delete');

        // bookings
        Route::get('/book',     [BookingController::class, 'create'])->name('booking.create');
        Route::post('/book',     [BookingController::class, 'store'])->name('booking.store');
        Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

        // reports
        Route::get('/reports',      [ReportController::class, 'parentReport'])->name('reports.parent');
        Route::post('/reports/{id}', [ReportController::class, 'parentShow'])->name('parent.report.show');
        Route::post('/report/{id}',  [ReportController::class, 'parentDownload'])->name('parent.report.download');
    });

    /*
    |----------------------------------------------------------------------
    | ♦ HOSPITAL PORTAL  (role: hospital) — URI prefix /hospital
    |----------------------------------------------------------------------
    */
    Route::prefix('hospital')->middleware('role:hospital')->group(function () {

        Route::get('/index', [HospitalController::class, 'index'])->name('hospital.dashboard');

        Route::get('/bookings',                 [HospitalController::class, 'bookings'])->name('hospital.bookings');
        Route::put('/bookings/{id}/{status}',   [HospitalController::class, 'updateStatus'])->name('hospital.booking.assign');

        Route::get('/reports',      [HospitalController::class, 'reports'])->name('hospital.reports');
        Route::post('/reports/{id}', [ReportController::class, 'hospitalShow'])->name('hospital.report.show');
        Route::post('/report/{id}',  [ReportController::class, 'hospitalDownload'])->name('hospital.report.download');
    });

    /*
    |----------------------------------------------------------------------
    | ♦ ADMIN PORTAL  (role: admin) — URI prefix /admin
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::get('/index', [AdminController::class, 'index'])->name('admin.dashboard');

        // hospitals
        Route::get('/hospitals',      [AdminController::class, 'hospitals'])->name('admin.hospitals');
        Route::post('/hospitals',      [AdminController::class, 'addhospital'])->name('admin.hospital.add');
        Route::put('/hospitals/{id}', [AdminController::class, 'editHospitals'])->name('admin.hospital.edit');
        Route::delete('/hospital/{id}',  [AdminController::class, 'deleteHospital'])->name('admin.hospital.delete');

        // parents
        Route::get('/parents',      [AdminController::class, 'parents'])->name('admin.parents');
        Route::post('/parents',      [AdminController::class, 'addParents'])->name('admin.parents.add');
        Route::put('/parents/{id}', [AdminController::class, 'editParents'])->name('admin.parents.edit');
        Route::delete('/parent/{id}',  [AdminController::class, 'deleteParent'])->name('admin.parent.delete');

        // children
        Route::get('/children',      [AdminController::class, 'children'])->name('admin.children');
        Route::post('/children',      [AdminController::class, 'addChild'])->name('admin.child.add');
        Route::put('/children/{id}', [AdminController::class, 'updateChild'])->name('admin.child.update');
        Route::delete('/children/{id}', [AdminController::class, 'deleteChild'])->name('admin.children.delete');

        // bookings
        Route::get('/bookings',              [BookingController::class, 'index'])->name('admin.bookings');
        Route::post('/bookings/{id}/status',  [BookingController::class, 'updateStatus'])->name('booking.assign');

        // vaccines
        Route::get('/vaccines',            [VaccineController::class, 'index'])->name('admin.vaccines');
        Route::post('/vaccines',            [VaccineController::class, 'store'])->name('vaccines.store');
        Route::post('/vaccines/{id}/toggle', [VaccineController::class, 'updateAvailability'])->name('vaccines.toggle');
        Route::delete('/vaccines/{id}',       [VaccineController::class, 'destroy'])->name('vaccines.destroy');

        // reports
        Route::get('/reports',      [ReportController::class, 'adminReport'])->name('admin.reports');
        Route::post('/reports/{id}', [ReportController::class, 'adminShow'])->name('admin.report.show');
        Route::post('/report/{id}',  [ReportController::class, 'adminDownload'])->name('admin.report.download');

        // approval requests
        Route::get('/requests',                [AdminController::class, 'requests'])->name('admin.requests');
        Route::post('/requests/{id}/{status}',  [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    });
});