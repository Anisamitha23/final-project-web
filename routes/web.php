<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

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
//     return redirect()->to('/home');
// });

Route::get('/', [PageController::class, 'dashboard']);


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register-form');
Route::post('/register', [LoginController::class, 'register'])->name('admin.register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login-form');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login');

// Route::get('/dashboard', function () {
//     return view('admin/admin-dashboard'); // Create this view for a successful login redirect
// })->middleware('auth'); // Protect dashboard route for logged-in users only

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu/add-to-order/{id}', [MenuController::class, 'addToOrder'])->name('menu.addToOrder');
Route::get('/orders', [MenuController::class, 'showOrder'])->name('menu.showOrder');

Route::get('/admin/add-menu', [AdminController::class, 'addMenu'])->name('menu.add');

