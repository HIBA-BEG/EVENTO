<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Models\Category;
use App\Models\Event;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/home', [CategoryController::class, 'view'])->middleware(['auth', 'admin'])->name('admin.home');

// Route::get('/HOME', [EventController::class, 'viewEvent'])->middleware(['auth', 'organizer'])->name('organizer.home');

Route::get('/home', function () {
    return view('organizer.home');
})->middleware(['auth', 'verified'])->name('organizer.home');


// Route::middleware('organizer')->group(function () {
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/Categories',[CategoryController::class, 'view'])->name('admin.home');
Route::get('/statistics',[AdminController::class, 'statistics'])->name('statistics');
Route::post('/Categories',[CategoryController::class, 'create'])->name('addCategory');
Route::put('/Category',[CategoryController::class, 'update'])->name('updateCategory');
Route::delete('/Categories/{category}',[CategoryController::class, 'delete'])->name('deleteCategory');

Route::get('/allEvents',[EventController::class, 'viewAll'])->name('allevents');

Route::get('/Events',[EventController::class, 'view'])->name('Events');
Route::post('/Events',[EventController::class, 'create'])->name('addEvent');
Route::patch('/update-status/{event}', [EventController::class, 'updateStatus'])->name('updateStatus');

Route::get('/EventsC', [EventController::class, 'viewClient'])->name('EventsC');

Route::delete('/Events/{event}', [EventController::class, 'delete'])->name('deleteEvent');
Route::put('/update-event', [EventController::class, 'update'])->name('updateEvent');
Route::get('/moreDetails/{id}', [EventController::class, 'showDetails'])->name('moreDetails');
// Route::post('/create-reservation/{eventId}', [ReservationController::class, 'createReservation'])->name('createReservation');
// Route::get('/view-reservations/{eventId}', [ReservationController::class, 'viewReservations'])->name('viewReservations');
// Route::patch('/update-reservation-status/{reservationId}', [ReservationController::class, 'updateReservationStatus'])->name('updateReservationStatus');




require __DIR__.'/auth.php';
