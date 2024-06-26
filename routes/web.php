<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
// use App\Http\Controllers\User\UserEventController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user routes
Route::middleware(['auth', 'userMiddleware'])->group(function(){
    Route::get('dashboard', [UserController::class,'index'])->name('dashboard');
    Route::get('/user-events', [UserEventController::class, 'index'])->name('user-events');
    Route::get('/user-events/{event}', [UserEventController::class, 'show'])->name('user.events.show');
    Route::get('/user-events/{event}/edit', [UserEventController::class, 'edit'])->name('user.events.edit');
    Route::put('/user-events/{event}', [UserEventController::class, 'update'])->name('user.events.update');
    Route::delete('/user-events/{event}', [UserEventController::class, 'destroy'])->name('user.events.destroy');
    Route::post('/user-events/{event}/register', [UserEventController::class, 'register'])->name('user.events.register');

});
// admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard', [Admincontroller::class,'index'])->name('admin.dashboard');
    Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events');
});


Route::post('/events', [EventController::class, 'store'])->name('events.store');



Route::prefix('admin')->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('admin.events.register');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('admin.events.show'); // Add this line
    Route::post('/events/{event}/add-comment', [EventController::class, 'addComment'])->name('admin.events.add-comment');
    Route::post('/events/{event}/rate', [EventController::class, 'storeRating'])->name('events.rate');
    Route::delete('/events/{event}/registrations/{registration}', [EventController::class, 'deleteRegistration'])->name('admin.events.delete-registration');

});

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user-events', [UserEventController::class, 'index'])->name('user-events');
    Route::get('/user-events/{event}', [UserEventController::class, 'show'])->name('user.events.show');
});






