<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/main', [MainController::class, 'main'])->middleware(['auth', 'verified']);

Route::get('/detail/{id}', [DetailController::class, 'view']);
Route::get('/detail', function(){

    return view('detail');
});



//////////////////////////////////////////////////////////////////////
Route::get('/addcompany', function(){
    return view('company.addcompany_user');
});

// عرض صفحة تسجيل الشركة (GET)
Route::get('/storecompany', function () {
    return view('company.addcompany_user');
})->name('storecompany.form');

// حفظ بيانات الشركة (POST)
Route::post('/storecompany', [RegisteredUserController::class, 'storecompany'])->name('storecompany');

Route::get('/viewcompany', [CompaniesController::class, 'viewcompany'])->name('viewcompany');
Route::get('/viewcompany', [CompaniesController::class, 'Viewcompany'])->name('viewcompany');
Route::put('/user/{id}', [CompaniesController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [CompaniesController::class, 'destroy'])->name('user.destroy');
////////////////////////////////////////////////////////////////////

Route::get('/addjob',function(){
    return view('jobs.addjob');
});

Route::post('/storejob', [JobController::class, 'Storejob']);
Route::get('/viewjob', [JobController::class, 'Addjob']);
/////////////////////
Route::post('/jobs/{id}/accept', [JobController::class, 'accept'])->name('jobs.accept');

Route::post('/jobs/{id}/cv_file', [JobController::class, 'CV'])->name('jobs.cv');

///////////////////////////////////////////////////////////////
Route::get('/admin', function(){

    return view('admin.mainadmin');
});


require __DIR__.'/auth.php';
