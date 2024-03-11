<?php

use App\Http\Controllers\HomeController;
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
    return view('welcome');
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

Route::get('/adminDash', [HomeController::class, 'adminDash'])->name('adminDash');
Route::get('/updateUsers/{user_id}', [HomeController::class, 'updateUsers'])->name('updateUsers');
Route::get('/updateUserDATA/{user_id}', [HomeController::class, 'updateUserDATA'])->name('updateUserDATA');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/deleteCat/{id}', [HomeController::class, 'deleteCat'])->name('deleteCat');
Route::get('/updateCategory/{id}', [HomeController::class, 'updateCategory'])->name('updateCategory');
Route::get('/updateCategoryDATA/{id}', [HomeController::class, 'updateCategoryDATA'])->name('updateCategoryDATA');
Route::get('/addCategory', [HomeController::class, 'addCategory'])->name('addCategory');
Route::get('/AddCat', [HomeController::class, 'AddCat'])->name('AddCat');
Route::get('/statistiques', [HomeController::class, 'Statistiques'])->name('statistiques');
Route::get('/evenements', [HomeController::class, 'evenements'])->name('evenements');
Route::get('/valide_event_statut/{id}', [HomeController::class, 'valide_event_statut'])->name('valide_event_statut');
Route::get('/rejeter_event_statut/{id}', [HomeController::class, 'rejeter_event_statut'])->name('rejeter_event_statut');


// organisateur 

Route::get('/organisateurDash', [HomeController::class, 'organisateurDash'])->name('organisateurDash');
Route::get('/updateEvent', [HomeController::class, 'updateEvent'])->name('updateEvent');
Route::get('/addEventView', [HomeController::class, 'addEventView'])->name('addEventView');
Route::post('/AddEvent', [HomeController::class, 'AddEvent'])->name('AddEvent');
Route::post('/updateEventView/{id}', [HomeController::class, 'updateEventView'])->name('updateEventView');
Route::post('/UpdateEvent/{id}', [HomeController::class, 'UpdateEvent'])->name('UpdateEvent');


Route::post('/search', 'HomeController@search')->name('search');

Route::get('/details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/index', [HomeController::class, 'Index'])->name('index');
require __DIR__.'/auth.php';
