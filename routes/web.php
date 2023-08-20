<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);



##################################### HOTEL ROOM TYPES CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/hotel_room_type', [App\Http\Controllers\HotelController::class, 'HotelRoomType']);
    Route::post('addRoomTypes', [App\Http\Controllers\HotelController::class, 'addRoomTypes'])->name('addRoomTypes.store');
    Route::post('updateRoomType', [App\Http\Controllers\HotelController::class, 'updateRoomType'])->name('updateRoomType');
    Route::delete('deleteRoomType/{id}', [App\Http\Controllers\HotelController::class, 'deleteRoomType'])->name('deleteRoomType'); 

});
###############################################################################################################################################


##################################### HOTEL FOOD TYPES CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/hotel_food_type', [App\Http\Controllers\HotelController::class, 'HotelFoodType']);
    Route::post('addFoodTypes', [App\Http\Controllers\HotelController::class, 'addFoodTypes'])->name('addFoodTypes.store');
    Route::post('updateFoodType', [App\Http\Controllers\HotelController::class, 'updateFoodType'])->name('updateFoodType');
    Route::delete('deleteFoodType/{id}', [App\Http\Controllers\HotelController::class, 'deleteFoodType'])->name('deleteFoodType'); 

});
###############################################################################################################################################

##################################### HOTEL FOOD ITEMS CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/get_food_items', [App\Http\Controllers\HotelController::class, 'GetFoodItems']);
    Route::post('addFoodItem', [App\Http\Controllers\HotelController::class, 'addFoodItem'])->name('addFoodItem');
    Route::get('edit_food_item/{id}', [App\Http\Controllers\HotelController::class, 'editFoodItem']);
    Route::post('update_food_item', [App\Http\Controllers\HotelController::class, 'updateFoodItem']);
    Route::delete('delete_food_item/{id}', [App\Http\Controllers\HotelController::class, 'deleteFoodItem']);

});
###############################################################################################################################################


















Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');






