<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('index');
});

Route::get('/dashboard', function () {
    return redirect()->route('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin
Route::middleware('auth')->group(function () {

    Route::get('/adminDash', [HomeController::class, 'adminDash'])->name('adminDash');
    Route::get('/updateUsers/{user_id}', [HomeController::class, 'updateUsers'])->name('updateUsers');
    Route::get('/updateUserDATA/{user_id}', [HomeController::class, 'updateUserDATA'])->name('updateUserDATA');
    Route::get('/categories', [categoryController::class, 'categories'])->name('categories');
    Route::get('/deleteCat/{id}', [categoryController::class, 'deleteCat'])->name('deleteCat');
    Route::get('/updateCategory/{id}', [categoryController::class, 'updateCategory'])->name('updateCategory');
    Route::get('/updateCategoryDATA/{id}', [categoryController::class, 'updateCategoryDATA'])->name('updateCategoryDATA');
    Route::get('/addCategory', [categoryController::class, 'addCategory'])->name('addCategory');
    Route::get('/AddCat', [categoryController::class, 'AddCat'])->name('AddCat');
    Route::get('/statistiques', [HomeController::class, 'Statistiques'])->name('statistiques');
    Route::get('/evenements', [eventController::class, 'evenements'])->name('evenements');
    Route::get('/bannerUser/{id}', [HomeController::class, 'bannerUser'])->name('bannerUser');
    Route::get('/valide_event_statut/{id}', [eventController::class, 'valide_event_statut'])->name('valide_event_statut');
    Route::get('/rejeter_event_statut/{id}', [eventController::class, 'rejeter_event_statut'])->name('rejeter_event_statut');
});


// organisateur 
Route::middleware('auth')->group(function () {

    Route::get('/organisateurDash', [HomeController::class, 'organisateurDash'])->name('organisateurDash');
    Route::get('/updateEvent', [eventController::class, 'updateEvent'])->name('updateEvent');
    Route::get('/addEventView', [eventController::class, 'addEventView'])->name('addEventView');
    Route::post('/AddEvent', [eventController::class, 'AddEvent'])->name('AddEvent');
    Route::post('/updateEventView/{id}', [eventController::class, 'updateEventView'])->name('updateEventView');
    Route::post('/UpdateEvent/{id}', [eventController::class, 'UpdateEvent'])->name('UpdateEvent');
    Route::get('/valider_reservation/{id}', [HomeController::class, 'valider_reservation'])->name('valider_reservation');
});

//generale
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/filtrer/{id}', [HomeController::class, 'filtrer'])->name('filtrer');

Route::get('/details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/index', [HomeController::class, 'Index'])->name('index');

//user
Route::middleware('auth')->group(function () {

    Route::get('/reserver/{id}', [HomeController::class, 'reserver'])->name('reserver');

    Route::get('/userDash', [HomeController::class, 'userDash'])->name('userDash');

    Route::get('/ticket/{id}', [HomeController::class, 'generate'])->name('generateTicket');

    Route::get('/reservations', [HomeController::class, 'reservations'])->name('reservations');
});

Route::get('/events', [eventController::class, 'events'])->name('events');
require __DIR__ . '/auth.php';
