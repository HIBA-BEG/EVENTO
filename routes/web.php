<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
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

Route::get('/HOME', [EventController::class, 'viewEvent'])->middleware(['auth', 'organizer'])->name('organizer.home');

// Route::middleware('organizer')->group(function () {
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/Categories',[CategoryController::class, 'view'])->name('admin.home0');
Route::post('/Categories',[CategoryController::class, 'create'])->name('addCategory');
Route::put('/Category',[CategoryController::class, 'update'])->name('updateCategory');
Route::delete('/Categories/{category}',[CategoryController::class, 'delete'])->name('deleteCategory');

Route::get('/allevents',[EventController::class, 'viewAll'])->name('allevents');

Route::get('/Events',[EventController::class, 'view'])->name('Events');
Route::post('/Events',[EventController::class, 'create'])->name('addEvent');
Route::patch('/update-status/{event}', [EventController::class, 'updateStatus'])->name('updateStatus');



require __DIR__.'/auth.php';
