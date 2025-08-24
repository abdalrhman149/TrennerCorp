<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainContrller;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/main', [MainController::class, 'main']);

Route::get('/detail/{id?}',[DetailController::class, 'View']);

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
