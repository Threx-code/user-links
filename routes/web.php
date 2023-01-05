<?php

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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


Route::middleware([])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user-page', [UserController::class, 'uniqueLink'])->name('user-page')->middleware('signed');
    Route::post('generate-link', [UserController::class, 'generateLink'])->name('generate-link');
    Route::post('deactivate-link', [UserController::class, 'deactivateLink'])->name('deactivate-link');
    Route::post('feeling-lucky', [UserController::class, 'feelingLucky'])->name('feeling-lucky');
    Route::post('history', [UserController::class, 'history'])->name('history');

    Route::get('admin/create-user', [AdminController::class, 'index'])->name('admin.create-user');
    Route::get('admin/all-users', [AdminController::class, 'allUsers'])->name('admin.all-users');
    Route::get('admin/edit-users/{user_id}', [AdminController::class, 'editUser'])->name('admin.edit-users');
    Route::post("admin/edit", [AdminController::class, 'update'])->name('admin.edit');
    Route::delete('admin/delete', [AdminController::class, 'delete'])->name('admin.delete');
}
);
