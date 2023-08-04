<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/',[PostController::class,'create'])->name('post#home');
Route::get('customer/createPage',[PostController::class,'create'])->name('post#createPage');
Route::post('post/create',[PostController::class,'postCreate'])->name('post#create');


// first way for delete function
Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');


// second way for delete function
// Route::delete('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');


// for update data
Route::get('post/updatePage',[PostController::class,'updatePage'])->name('post#updatePage');

//for display data with detail form
Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('post#updatePage');

// for display to edit page.
Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('post#editPage');

// to carry for update data into the database.
Route::post('post/update}',[PostController::class,'update'])->name('post#update');


// Route::get('testing',function(){
// 	return "this is testing......";
// })->name('test');


