<?php

use App\Http\Controllers\AdminUserController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BookController::class, 'index'])->name('index');

Route::group(['prefix' => 'book', 'middleware'=>['auth', 'permission']], function() {

Route::get('/create', [BookController::class, 'create'])->name('book-create');

Route::post('/book', [BookController::class, 'store'])->name('book-store');

Route::get('/manage', [BookController::class, 'manage'])->name('book-manage');

Route::get('/{book}/edit', [BookController::class, 'edit'])->name('book-edit');

Route::put('/{book}', [BookController::class, 'update'])->name('book-update');

Route::delete('/{book}', [BookController::class, 'destroy'])->name('book-destroy');





});

Route::get('/book/{book}', [BookController::class, 'show'])->name('book-show');



Route::group(['prefix' => 'user','middleware'=>['guest']], 

function() { 

Route::get('/register', [UserController::class, 'create'])->name('user-create');

Route::post('/users',[UserController::class, 'store'])->name('user-store');



Route::post('/users/authenticate',[UserController::class, 'authenticate'])->name('user-authenticate');



Route::get('/login',[UserController::class, 'login'])->name('login');


});

Route::post('user/logout',[UserController::class, 'logout'])->name('logout')->middleware('auth');




// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin-index');
Route::group(['prefix' => 'admin', 'middleware'=>['auth', 'permission']], function() {
Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);


Route::group(['prefix' => 'users', 'middleware'=>['auth', 'permission']], function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/create', [UsersController::class, 'store'])->name('users.store');
    Route::get('/{user}/show', [UsersController::class, 'show'] )->name('users.show');
    Route::get('/{user}/edit',  [UsersController::class, 'edit'] )->name('users.edit');
    Route::patch('/{user}/update',  [UsersController::class, 'update'] )->name('users.update');
    Route::delete('/{user}/delete',  [UsersController::class, 'destroy'] )->name('users.destroy');
});

});

Route::group(['prefix' => 'reservation', 'middleware'=>['auth', 'permission']], function() {
    Route::get('/', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/create', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/{reserve}/show', [ReservationController::class, 'show'] )->name('reservation.show');
    Route::get('/{reserve}/edit',  [ReservationController::class, 'edit'] )->name('reservation.edit');
    Route::patch('/{reserve}/update',  [ReservationController::class, 'update'] )->name('reservation.update');
    Route::delete('/{reserve}/delete',  [ReservationController::class, 'destroy'] )->name('reservation.destroy');
});