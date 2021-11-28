<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firstcontroller;


Route::get('/', function () {
    return view('welcome');
});

Route::get('add',[firstcontroller::class , "create"] );
Route::get('show',[firstcontroller::class , "index"] );
Route::post('adddone',[firstcontroller::class , "store"] );
Route::get('delete/{id}',[firstcontroller::class , "destroy"] );
Route::get('edit/{id}',[firstcontroller::class , "edit"] );
Route::post('editdone/{id}',[firstcontroller::class , "update"] );

