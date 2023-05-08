<?php

use App\Http\Controllers\ContenusController;
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

// Route::get('/', function(){
//     return view("welcome");
// });

Route::get('/', [ContenusController::class, 'index'])->name('accueil');
Route::get('/moreinfo/{idContenu}/{title}', [ContenusController::class, "moreInfo"])->name('moreInfo');

Route::get('/login', function(){
    return view("login");
})->name('login');

Route::get('/verifyLogin', [ContenusController::class, "verifyLogin"])->name("verifyLogin");

Route::get('/ajouterArticle', function(){
    return view('ajouter');
})->name('ajouterArticle');

Route::post('/insertContenu', [ContenusController::class, "insertContenu"])->middleware('web')->name('insertContenu');

Route::get('/modifierContenu', [ContenusController::class, "modifierContenu"])->middleware('web')->name('modifierContenu');

Route::post('/modifyContent', [ContenusController::class, "modifyContent"])->middleware('web')->name('modifyContent');

Route::get('/supprimerContenu', [ContenusController::class, "supprimerContenu"])->middleware('web')->name('supprimerContenu');

Route::get('/logout', [ContenusController::class, "logout"])->middleware('web')->name('logout');