<?php

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

use App\Http\Controllers\AjaxBOOKCRUDController; 

Route::get('ajax-book-crud', [AjaxBOOKCRUDController::class, 'index']); 

Route::post('save-book', [AjaxBOOKCRUDController::class, 'store']); 

Route::get('fetch-books', [AjaxBOOKCRUDController::class, 'fetchBooks']); 

Route::get('edit-book/{id}', [AjaxBOOKCRUDController::class, 'edit']); 

Route::put('update-book/{id}', [AjaxBOOKCRUDController::class, 'update']); 

Route::delete('delete-book/{id}', [AjaxBOOKCRUDController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});
