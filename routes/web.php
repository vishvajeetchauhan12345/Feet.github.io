<?php

Auth::routes();

Route::get("/clear_cache", function () {
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
});
Route::get("/", 'HomeController@index')->middleware(['lang_check', 'auth']);
Route::group(['middleware' => ['lang_check', 'auth', 'officeadmin']], function () {

	Route::post('/income_records', 'Income@income_records');
	Route::post('/expense_records', 'ExpenseController@expense_records');
	Route::post('/store_insurance', 'VehiclesController@store_insurance');
	Route::resource('/fuel', 'FuelController');
	Route::resource('/drivers', 'DriversController');
	Route::resource('/parts', 'PartsController');
	Route::resource('/vehicles', 'VehiclesController');
	Route::resource('/bookings', 'BookingsController');
	Route::resource('/acquisition', 'AcquisitionController');
	Route::resource('/income', 'Income');
	Route::resource('/stock', 'StockController');
	Route::resource('/settings', 'SettingsController');
	Route::resource('/customers', 'CustomersController');
	Route::resource('/transaction', 'PartsTransaction');
	Route::resource('/expense', 'ExpenseController');
	Route::resource('/expensecategories', 'ExpenseCategories');
	Route::resource('/incomecategories', 'IncomeCategories');
	Route::resource('/searchdrivers', 'SearchdriversController');
	Route::resource('/searchvehicles', 'SearchvehiclesController');

	Route::get('/bookings/complete/{id}', 'BookingsController@complete');
	Route::get('/bookings/receipt/{id}', 'BookingsController@receipt');
	Route::get("/reports/monthly", "ReportsController@monthly")->name("reports.monthly");
	Route::get("/reports/parts", "ReportsController@parts")->name("reports.parts");
	Route::get("/reports/booking", "ReportsController@booking")->name("reports.booking");
	Route::get("/reports/delinquent", "ReportsController@delinquent")->name("reports.delinquent");
	Route::get('/calendar', 'BookingsController@calendar');
	Route::get('/calendar/event/{id}', 'BookingsController@calendar_event');
	Route::get('/vehicle/event/{id}', 'VehiclesController@view_event');
	Route::get("/drivers/enable/{id}", 'DriversController@enable');
	Route::get("/drivers/disable/{id}", 'DriversController@disable');
	Route::get("/reports/vehicle", "ReportsController@vehicle")->name("reports.vehicle");
	Route::get("/reports/driver", "ReportsController@driver")->name("reports.driver");
	Route::get('/stock/add/{id}', 'StockController@add');

	Route::post("/reports/booking", "ReportsController@booking_post")->name("reports.booking");
	Route::post('/customer/ajax_save', 'CustomersController@ajax_store')->name('customers.ajax_store');
	Route::get("/bookings_calendar", 'BookingsController@calendar_view')->name("bookings.calendar");
	Route::get('/calendar/event/{id}', 'BookingsController@calendar_event');
	Route::get('/calendar', 'BookingsController@calendar');
	Route::post('/drivers/add', 'DriversController@add');
	Route::post('/searchvehicles/search', 'SearchvehiclesController@search');
	Route::post('/searchdrivers/search', 'SearchdriversController@search');
	Route::post('/get_driver', 'BookingsController@get_driver');
	Route::post('/get_vehicle', 'BookingsController@get_vehicle');
	Route::post('/bookings/complete', 'BookingsController@complete_post')->name("bookings.complete");
	Route::get('/bookings/complete', 'BookingsController@complete_post')->name("bookings.complete");

	Route::post("/reports/monthly", "ReportsController@monthly_post")->name("reports.monthly");
	Route::post("/reports/booking", "ReportsController@booking_post")->name("reports.booking");
	Route::post("/reports/parts", "ReportsController@parts_post")->name("reports.parts");
	Route::post("/reports/delinquent", "ReportsController@delinquent_post")->name("reports.delinquent");
});
Route::group(['middleware' => ['lang_check', 'auth']], function () {
	Route::get('/changepass/{id}', 'UtilityController@changepass')->name("changepass");
	Route::post('/changepass/{id}', 'UtilityController@changepassword')->name("changepass");

	Route::get('/vehicle_notification/{type}', 'NotificationController@vehicle_notification');

	Route::get('driver_notification/{type}', 'NotificationController@driver_notification');

	Route::get('/my_bookings', 'DriversController@my_bookings')->name('my_bookings');
});
Route::group(['middleware' => ['lang_check', 'auth', 'superadmin']], function () {
	Route::resource('/users', 'UsersController');
});