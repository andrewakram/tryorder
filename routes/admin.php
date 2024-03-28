<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\QrcodeController;
use App\Http\Controllers\frontController;


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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('Login', [frontController::class, 'login']);
Route::get('logout', [frontController::class, 'logout']);

Route::get('forget-password', [frontController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [frontController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}/{email}', [frontController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [frontController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => ['admin']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

    Route::group(['prefix' => 'categories', 'as' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('.index');
        Route::get('getData', [CategoryController::class, 'getData'])->name('.datatable');
//        Route::get('/create', [CategoryController::class, 'create'])->name('.create');
//        Route::post('/store', [CategoryController::class, 'store'])->name('.store');
//        Route::post('search', [CategoryController::class, 'search'])->name('.search');
//        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('.edit');
//        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('.update');
//        Route::get('/delete', [CategoryController::class, 'delete'])->name('.delete');
//        Route::get('/add-button', [CategoryController::class, 'table_buttons'])->name('.add-button');

    });

    Route::group(['prefix' => 'subcategories', 'as' => 'subcategories'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('.index');
        Route::get('getData', [SubCategoryController::class, 'getData'])->name('.datatable');
//        Route::get('/create', [SubCategoryController::class, 'create'])->name('.create');
//        Route::post('/store', [SubCategoryController::class, 'store'])->name('.store');
//        Route::post('search', [SubCategoryController::class, 'search'])->name('.search');
//        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('.edit');
//        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('.update');
//        Route::get('/delete', [SubCategoryController::class, 'delete'])->name('.delete');
//        Route::get('/add-button', [SubCategoryController::class, 'table_buttons'])->name('.add-button');

    });

    Route::group(['prefix' => 'subcategories', 'as' => 'subcategories'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('.index');
        Route::get('getData', [SubCategoryController::class, 'getData'])->name('.datatable');
//        Route::get('/create', [CategoryController::class, 'create'])->name('.create');
//        Route::post('/store', [CategoryController::class, 'store'])->name('.store');
//        Route::post('search', [CategoryController::class, 'search'])->name('.search');
//        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('.edit');
//        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('.update');
//        Route::get('/delete', [CategoryController::class, 'delete'])->name('.delete');
//        Route::get('/add-button', [CategoryController::class, 'table_buttons'])->name('.add-button');

    });

    Route::group(['prefix' => 'qrcodes', 'as' => 'qrcodes'], function () {
        Route::get('/', [QrcodeController::class, 'index'])->name('.index');
        Route::get('getData', [QrcodeController::class, 'getData'])->name('.datatable');
        Route::get('/create', [QrcodeController::class, 'create'])->name('.create');
        Route::post('/store', [QrcodeController::class, 'store'])->name('.store');
//        Route::post('search', [QrcodeController::class, 'search'])->name('.search');
//        Route::get('/edit/{id}', [QrcodeController::class, 'edit'])->name('.edit');
//        Route::post('/update/{id}', [QrcodeController::class, 'update'])->name('.update');
//        Route::get('/delete', [QrcodeController::class, 'delete'])->name('.delete');
        Route::get('/add-button', [QrcodeController::class, 'table_buttons'])->name('.add-button');
        Route::get('/getSubCats', [QrcodeController::class, 'getSubCats'])->name('.getSubCats');

    });

});
