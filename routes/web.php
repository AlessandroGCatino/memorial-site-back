<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\HomePicturesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
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

Route::get('/tutorials', function () {
    return view('tutorials');
})->middleware(['auth', 'verified'])->name('tutorials');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware("auth")->group( function(){
    Route::resource("articles", ArticleController::class);
    Route::resource("artists", ArtistController::class);
    Route::resource("exhibitions", ExhibitionController::class);
    Route::resource("sections", SectionController::class);
    Route::resource("homepictures", HomePicturesController::class);
});



require __DIR__.'/auth.php';
