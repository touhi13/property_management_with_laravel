<?php

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

Route::view('/', 'welcome');


//cache clear 
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//route clear 
Route::get('/clear-route', function() {
    $exitCode = Artisan::call('route:cache ');
    // return what you want
});

//config clear 
Route::get('/clear-config', function() {
    $exitCode = Artisan::call('config:clear');
    // return what you want
});

//config clear 
Route::get('/clear', function() {
    $exitCode = Artisan::call('config:cache');
    // return what you want
});

//view clear 
Route::get('/clear-view', function() {
    $exitCode = Artisan::call('view:clear');
    // return what you want
});

//storage link 
Route::get('/storage-link', function() {
    $exitCode = Artisan::call('storage:link');
    // return what you want
});

Route::view('/', 'welcome');
Auth::routes();
 // SSLCOMMERZ Start
 Route::get('/pay', 'PublicSslCommerzPaymentController@index');
 Route::POST('/success', 'PublicSslCommerzPaymentController@success');
 Route::POST('/fail', 'PublicSslCommerzPaymentController@fail');
 Route::POST('/cancel', 'PublicSslCommerzPaymentController@cancel');
 Route::POST('/ipn', 'PublicSslCommerzPaymentController@ipn');
//SSLCOMMERZ END

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/manager', 'Auth\LoginController@showManagerLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/manager/{package}', 'Auth\RegisterController@showManagerRegisterForm');
Route::get('/package', 'Auth\RegisterController@package');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/manager', 'Auth\LoginController@managerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/manager', 'Auth\RegisterController@createManager');


Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth:admin',
    ],
    function () {
        Route::get('', 'DashboardController@index');
        Route::resource('approval', 'ApproveManagerController');        
        Route::resource('package', 'PackageController');
        Route::resource('payment', 'PaymentController');
        Route::post('setstatus', 'PackageController@setstatus');
        Route::resource('category', 'CategoryController');
        Route::resource('subcategory', 'SubcategoryController');
        Route::post('setmanagerapproval', 'ApproveManagerController@setapproval');
        Route::get('banner', 'BannerController@image');
        Route::post('bannerupload', array('as' => 'storebanner', 'uses' =>'BannerController@bannerupload'));
    }
);

Route::group(
    [
        'prefix' => 'manager',
        'namespace' => 'manager',
        'middleware' => 'auth:manager',
    ],
    function () {
        Route::get('', 'DashboardController@index');
        Route::get('get_vaccant_unit/', 'DashboardController@getVaccantUnit');
        Route::resource('property', 'PropertyController');
        //Route::get('property/edit/{id}', 'PropertyController@edit');
        Route::get('property/show/{id}', 'PropertyController@show');
        Route::resource('place', 'PlaceController');
        Route::get('place/', 'PlaceController@index');
        Route::get('createunit', 'PlaceController@createUnit');
        Route::post('place/storeunit', array('as' => 'storeunit', 'uses' =>'PlaceController@storeUnit'));
        Route::get('place/edit/{id}', 'PlaceController@edit');
        Route::post('place/update', 'PlaceController@update');
        Route::delete('place/destroy', 'PlaceController@destroy');
        Route::post('place/store', array('as' => 'storeplace', 'uses' =>'PlaceController@store'));
        Route::get('place/create/{id}', 'PlaceController@create');
        Route::get('getsubcategory/{catid}', 'PlaceController@selectsubcat');
        Route::resource('tenant', 'TenantController');
        Route::get('getplace/{levelid}', 'TenantController@selectplace');
        Route::get('getunit/{levelid}', 'TenantController@selectunit');
        Route::get('getlevel/{proid}', 'TenantController@selectlevel');
        Route::get('getseat/{stid}', 'TenantController@selectSeat');
        Route::get('gettenant/{id}', 'ReportController@selecttenant');
        Route::post('exittenant', 'TenantController@exittenats');
        Route::get('messunit', 'TenantController@messunit');
        Route::get('createmstenant', 'TenantController@createmstenant');
        Route::resource('rent', 'CollectRentController');
        Route::post('detailrent', 'CollectRentController@drent');
        Route::post('rent/search', 'CollectRentController@search');
        Route::post('rent/collectrent', array('as' => 'collectrent', 'uses' => 'CollectRentController@collectrent'));
        Route::resource('expense', 'ExpenseController');
        Route::resource('level', 'LevelController');
        Route::resource('employee', 'EmployeeController');
        Route::post('employeeout', 'EmployeeController@exitemployees');
        Route::resource('employee_salary', 'EmployeeSalaryController');
        Route::post('employee_salary/givesalary', array('as' => 'givesalary', 'uses' => 'EmployeeSalaryController@giveSalary'));
        Route::get('getemployee/{id}', 'EmployeeSalaryController@selectemployee');
        //Route::resource('report','ReportController');
        Route::get('report/tenantreport', 'ReportController@index');
        Route::post('report/tenantresult', array('as' => 'store', 'uses' => 'ReportController@store'));
        Route::get('report/unitreport', 'ReportController@unitreport');
        Route::post('report/unitresult', array('as' => 'unitresult', 'uses' => 'ReportController@unitReportResult'));
        Route::get('report/salaryreport', 'ReportController@salaryreport');
        Route::post('report/salaryresult', array('as' => 'salaryresult', 'uses' => 'ReportController@salaryReportResult'));
        Route::get('report/rentreport', 'ReportController@rentReport');
        Route::post('report/rentresult', array('as' => 'rentresult', 'uses' => 'ReportController@rentresult'));
        Route::resource('mess', 'MessController');
        Route::resource('seat', 'SeatController');        
        Route::get('getmess/{levelid}', 'SeatController@selectmess');
    }
);
