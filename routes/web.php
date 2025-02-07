<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SaleController;
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

// Route::get('/', function () {
//     return view('home');
// });
Route::middleware(['checkUser'])->group(function () {
Route::get('/user', [UserController::class, 'index'])->name('user.all');
Route::post('/user/add', [UserController::class, 'store'])->name('user.store');
Route::post('/user/pass', [UserController::class, 'newpassword'])->name('user.pass');
Route::get('/get-user', [UserController::class, 'getuser'])->name('get.user');
Route::get('/user/lead', [LeadController::class, 'userlead'])->name('user.lead.all');
Route::get('/user/lead-sale', [LeadController::class, 'userleads'])->name('user.leads.all');
Route::get('/user/lead-aproved', [LeadController::class, 'userleada'])->name('user.leada.all');

Route::post('/lead/update-status', [LeadController::class, 'updateStatus'])->name('lead.updateStatus');

Route::get('/lead', [LeadController::class, 'index'])->name('lead.all');

Route::post('/lead/add', [LeadController::class, 'store'])->name('lead.store');
Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('lead.edit');
Route::post('/lead/{id}/update', [LeadController::class, 'update'])->name('lead.update');

Route::get('/sale', [SaleController::class, 'index'])->name('sale.all');
Route::post('/sale/add', [SaleController::class, 'store'])->name('sale.store');
Route::get('/sale/{id}/edit', [SaleController::class, 'edit'])->name('sale.edit');
Route::post('/sale/{id}/update', [SaleController::class, 'update'])->name('sale.update');
Route::post('/sale/update-status', [SaleController::class, 'updateStatus'])->name('sale.updateStatus');
});

Route::get('/', [UserController::class, 'showLoginForm']);
Route::post('/login/user', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
