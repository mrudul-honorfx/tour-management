<?php

use App\Models\AirlineProviders;
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

// enable the auth middleware for all routes

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'booking'], function(){
        Route::get('/new/{packageId}', [App\Http\Controllers\BookingController::class, 'addbooking'])->name('addbooking');
        Route::post('/submitBooking', [App\Http\Controllers\BookingController::class, 'createBooking'])->name('submitBooking');
        Route::get('/blisting', [App\Http\Controllers\BookingController::class, 'blisting'])->name('blisting');
        Route::get('/generateBookingVoucher/{id}', [App\Http\Controllers\BookingController::class, 'generateBookingVoucher'])->name('generateBookingVoucher');
    });
    
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'root']);

Route::get('/getVoucher',[App\Http\Controllers\VoucherController::class, 'getVoucher'])->name('getVoucher');

Route::get('/filterView', [App\Http\Controllers\HomeController::class, 'getPackageByFilters'])->name('filterView');


##################################### HOTEL ROOM TYPES CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/hotel_room_type', [App\Http\Controllers\HotelController::class, 'HotelRoomType']);
    Route::post('addRoomTypes', [App\Http\Controllers\HotelController::class, 'addRoomTypes'])->name('addRoomTypes.store');
    Route::post('updateRoomType', [App\Http\Controllers\HotelController::class, 'updateRoomType'])->name('updateRoomType');
    Route::delete('deleteRoomType/{id}', [App\Http\Controllers\HotelController::class, 'deleteRoomType'])->name('deleteRoomType'); 
    Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'viewHotelsList']);
    Route::post('addHotel', [App\Http\Controllers\HotelController::class, 'addHotel'])->name('addHotel.store');

});
###############################################################################################################################################

##################################### Package CRUD  ####################################################################################

Route::group(['prefix' => 'package'], function(){
    Route::get('/add', [App\Http\Controllers\PackageController::class, 'index'])->name('addPackage');
    Route::post('/savePackage', [App\Http\Controllers\PackageController::class, 'createTourPackage'])->name('addPackage.store');
    Route::get('/all', [App\Http\Controllers\PackageController::class, 'viewPackages']);
    Route::get('/plisting', [App\Http\Controllers\PackageController::class, 'getPackageList'])->name('package.plisting');
    Route::post('/plisting', [App\Http\Controllers\PackageController::class, 'getFilteredPackageList'])->name('fliterListing');
    Route::post('/filtered-packages', [App\Http\Controllers\PackageController::class, 'getFilteredPackage'])->name('filtered-packages');


});
###############################################################################################################################################
##################################### Booking CRUD  ####################################################################################

Route::group(['prefix' => 'booking'], function(){
    Route::get('/new/{packageId}', [App\Http\Controllers\BookingController::class, 'addbooking'])->name('addbooking');
    Route::post('/submitBooking', [App\Http\Controllers\BookingController::class, 'createBooking'])->name('submitBooking');
    Route::get('/blisting', [App\Http\Controllers\BookingController::class, 'blisting'])->name('blisting');
    Route::get('/generateBookingVoucher/{id}', [App\Http\Controllers\BookingController::class, 'generateBookingVoucher'])->name('generateBookingVoucher');
});
###############################################################################################################################################


##################################### Airline CRUD  ####################################################################################

Route::group(['prefix' => 'airline'], function(){
    Route::get('/addProvider', [App\Http\Controllers\AirlineController::class, 'airlineProviderList'])->name('listAirlines');
    Route::get('/addAirport', [App\Http\Controllers\AirlineController::class, 'airportDestinationList'])->name('listAirports');
    // Route::post('addRoomTypes', [App\Http\Controllers\HotelController::class, 'addRoomTypes'])->name('addRoomTypes.store');
    // Route::post('updateRoomType', [App\Http\Controllers\HotelController::class, 'updateRoomType'])->name('updateRoomType');
    // Route::delete('deleteRoomType/{id}', [App\Http\Controllers\HotelController::class, 'deleteRoomType'])->name('deleteRoomType'); 
    // Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'viewHotelsList']);
    // Route::post('addHotel', [App\Http\Controllers\HotelController::class, 'addHotel'])->name('addHotel.store');

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
    Route::post('addFoodItem', [App\Http\Controllers\HotelController::class, 'addFoodItem'])->name('addFoodItem.store');
    Route::get('edit_food_item/{id}', [App\Http\Controllers\HotelController::class, 'editFoodItem']);
    Route::post('update_food_item', [App\Http\Controllers\HotelController::class, 'updateFoodItem']);
    Route::get('deleteFoodItem/{id}', [App\Http\Controllers\HotelController::class, 'deleteFoodItem'])->name('deleteFoodItem');

});
###############################################################################################################################################

##################################### HOTEL VIEW TYPES CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/hotel_view_type', [App\Http\Controllers\HotelController::class, 'HotelViewType']);
    Route::post('addViewTypes', [App\Http\Controllers\HotelController::class, 'addViewTypes'])->name('addViewTypes.store');
    Route::post('updateViewType', [App\Http\Controllers\HotelController::class, 'updateViewType'])->name('updateViewType');
    Route::delete('deleteViewType/{id}', [App\Http\Controllers\HotelController::class, 'deleteViewType'])->name('deleteViewType'); 

});
###############################################################################################################################################

##################################### HOTEL CRUD  ####################################################################################

Route::group(['prefix' => 'hotel'], function(){
    Route::get('/hotel_list', [App\Http\Controllers\HotelController::class, 'HotelList']);
    Route::post('addViewTypes', [App\Http\Controllers\HotelController::class, 'addViewTypes'])->name('addViewTypes.store');
    Route::post('updateViewType', [App\Http\Controllers\HotelController::class, 'updateViewType'])->name('updateViewType');
    Route::delete('deleteViewType/{id}', [App\Http\Controllers\HotelController::class, 'deleteViewType'])->name('deleteViewType'); 

});
###############################################################################################################################################
##################################### STAFF CRUD  ####################################################################################

Route::group(['prefix' => 'staff'], function(){
    Route::get('/staff_list', [App\Http\Controllers\StaffController::class, 'StaffList']);
    Route::post('addStaff', [App\Http\Controllers\StaffController::class, 'addStaff'])->name('addStaff.store');
    Route::post('updateStaffUser', [App\Http\Controllers\StaffController::class, 'updateStaffUser'])->name('updateStaffUser');
    Route::delete('deleteStaffUser/{id}', [App\Http\Controllers\StaffController::class, 'deleteStaffUser'])->name('deleteStaffUser'); 

});
###############################################################################################################################################
##################################### ROLES CRUD  ####################################################################################

Route::group(['prefix' => 'staff'], function(){
    Route::get('/role', [App\Http\Controllers\StaffController::class, 'RoleList']);
    Route::post('addRole', [App\Http\Controllers\StaffController::class, 'addRole'])->name('addRole.store');
    Route::post('updateRoles', [App\Http\Controllers\StaffController::class, 'updateRoles'])->name('updateRoles');
    Route::delete('deleteRole/{id}', [App\Http\Controllers\StaffController::class, 'deleteRole'])->name('deleteRole'); 
   
});
###############################################################################################################################################
##################################### PERMISSION CATEGORY CRUD  ####################################################################################

Route::group(['prefix' => 'permission'], function(){
    Route::get('/permission_list', [App\Http\Controllers\StaffController::class, 'permissionList']);
    Route::get('/role-permission/{cat_id}', [App\Http\Controllers\StaffController::class, 'RolePermissions']);
    Route::get('/permissions/{cat_id}', [App\Http\Controllers\StaffController::class, 'permissions']);
    Route::post('updateRolePermission', [App\Http\Controllers\StaffController::class, 'updateRolePermission'])->name('updateRolePermission');

    Route::get('/permission_mapping', [App\Http\Controllers\StaffController::class, 'permissionMapping']);
    
    Route::post('addPermission', [App\Http\Controllers\StaffController::class, 'addPermission'])->name('permissions.store');

    Route::post('addPcategory', [App\Http\Controllers\StaffController::class, 'addPcategory'])->name('pCategory.store');
    Route::post('updatePcategory', [App\Http\Controllers\StaffController::class, 'updatePcategory'])->name('updatePcategory');
    Route::delete('deletePcategory/{id}', [App\Http\Controllers\StaffController::class, 'deletePcategory'])->name('deletePcategory'); 
   

});
###############################################################################################################################################
// admin route group for managing booking ajax requests

Route::group(['prefix' => 'admin'],function(){
    Route::post('/booking/approve',[App\Http\Controllers\BookingController::class, 'approveBooking'])->name('approveBooking');
    Route::post('/booking/reject',[App\Http\Controllers\BookingController::class, 'rejectBooking'])->name('rejectBooking');

});




















Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');






