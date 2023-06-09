<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

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

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/search/add', [PublicController::class, 'searchAdds'])->name('adds.search');
Route::post('/language/{lang}', [PublicController::class,'setLanguage'])->name('setLocale');
Route::get('/staff',[PublicController::class,'staff'])->name('staff');
Route::get('/lavoraConNoi',[PublicController::class,'lavoraConNoi'])->name('lavoraConNoi');

Route::get('/add/create', [AddController::class, 'create'])->middleware('auth')->name('add.create');


Route::get('/add/index', [AddController::class, 'index'])->name('add.index');
Route::get('/add/index/{sortedCategory}',[AddController::class,'categoryIndex'])->name('adds.category');
Route::get('/add/show/{add}',[AddController::class,'show'])->name('add.show');

Route::get('/revisor/home', [RevisorController::class,'index'])->middleware('isRevisor')->name('revisor.index');

Route::patch('/accept/add/{add}', [RevisorController::class,'AcceptAdd'])->middleware('isRevisor')->name('revisor.addAccepted');
Route::patch('/goback/add/', [RevisorController::class,'addBack'])->middleware('isRevisor')->name('revisor.addBack');
Route::patch('/refuse/add/{add}', [RevisorController::class,'RefuseAdd'])->middleware('isRevisor')->name('revisor.addRefused');
Route::get('/request/revisor', [RevisorController::class,'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('/make/revisor/{user}', [RevisorController::class,'makeRevisor'])->middleware('auth')->name('make.revisor');
