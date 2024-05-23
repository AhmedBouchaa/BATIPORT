<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BatimentController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\EtageController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\CommutateurController;
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

Route::get('/dashboard',[BatimentController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//les routes des batiments
Route::get('/batiment/{theid}/show',[BatimentController::class,'show'])->name('batiment.show');
Route::get('/batiment/create',[BatimentController::class,'create'])->name('batiment.create');
Route::post('/batiment',[BatimentController::class,'store'])->name('batiment.store');
Route::get('/batiment/{batiment}/edit',[BatimentController::class,'edit'])->name('batiment.edit');
Route::put('/batiment/{batiment}/update',[BatimentController::class,'update'])->name('batiment.update');
Route::delete('/batiment/{batiment}/destroy',[BatimentController::class,'destroy'])->name('batiment.destroy');


//les routes des etages
Route::post('/etage', function () {
    return view('welcome');
});
Route::get('/etage/{theid}/show',[EtageController::class,'show'])->name('etage.show');
Route::get('/etage/{theid}/create',[EtageController::class,'create'])->name('etage.create');
Route::post('/etage/{theid}',[EtageController::class,'store'])->name('etage.store');
Route::get('/etage/{etage}/{theid}/edit',[EtageController::class,'edit'])->name('etage.edit');
Route::put('/etage/{etage}/{theid}/update',[EtageController::class,'update'])->name('etage.update');
Route::delete('/etage/{etage}/{theid}/destroy',[EtageController::class,'destroy'])->name('etage.destroy');

//les routes des bureaux
Route::get('/bureau/{theid}/show/{batiment_id}',[BureauController::class,'show'])->name('bureau.show');
Route::get('/bureau/{theid}/create',[BureauController::class,'create'])->name('bureau.create');
Route::post('/bureau/{theid}',[BureauController::class,'store'])->name('bureau.store');
Route::get('/bureau/{bureau}/{theid}/edit',[BureauController::class,'edit'])->name('bureau.edit');
Route::put('/bureau/{bureau}/{theid}/update',[BureauController::class,'update'])->name('bureau.update');
Route::delete('/bureau/{bureau}/{theid}/destroy',[BureauController::class,'destroy'])->name('bureau.destroy');

//les routes des ports
Route::get('/port/{theid}/create/{batiment_id}',[PortController::class,'create'])->name('port.create');


Route::get('port/change{pid}/{bid}/{batiment_id}',[PortController::class,'change'])->name('port.change');

//les routes des commutateurs
Route::get('/commutateur/create/{batiment_id}',[CommutateurController::class,'create'])->name('commutateur.create');
Route::post('/commutateur/{batiment_id}',[CommutateurController::class,'store'])->name('commutateur.store');
Route::delete('/commutateur/{commutateur}/{theid}/destroy',[CommutateurController::class,'destroy'])->name('commutateur.destroy');


// Documentation
Route::get('/Documentation',function(){
    return view('documentation');
})->middleware(['auth', 'verified'])->name('Documentation');
require __DIR__.'/auth.php';
