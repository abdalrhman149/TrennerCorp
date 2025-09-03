<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
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
Route::get('/main', [MainController::class, 'main']);

Route::get('/detail/{id}', [DetailController::class, 'view']);
Route::get('/detail', function(){

    return view('detail');
});


//////////////////////////////////////////////////////////////////////
Route::get('/addcompany', function(){
    return view('company.addcompany');
});
Route::post('/storecompany', [CompaniesController::class, 'Storecompany']);
Route::get('/viewcompany', [CompaniesController::class, 'Viewcompany']);

////////////////////////////////////////////////////////////////////

Route::get('/addjob',function(){
    return view('jobs.addjob');
});

Route::post('/storejob', [JobController::class, 'Storejob']);
Route::get('/viewjob', [JobController::class, 'Addjob']);
/////////////////////


require __DIR__.'/auth.php';
