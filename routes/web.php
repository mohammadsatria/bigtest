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
Auth::routes();

Route::get('/', 'Dashboard\Dashboard@index')->name('dashboard');
// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'Dashboard\Dashboard@index')->name('dashboard');
});

// Settings
Route::prefix('settings')->group(function () {
    // Menu
    Route::prefix('menu')->group(function () {
        Route::get('/', 'Menu@main')->name('menu-main');
        Route::get('index', 'Menu@index')->name('menu-index');
        Route::get('menu-add', 'Menu@add')->name('menu-add');
        Route::get('menu-edit/{id?}/{level?}', 'Menu@edit')->name('menu-edit');

        Route::post('getparent', 'Menu@getMenu')->name('menu-getparent');
        Route::post('getorder', 'Menu@getOrder')->name('menu-getorder');
        Route::post('store', 'Menu@store')->name('menu-store');
        Route::post('getrow', 'Menu@getRow')->name('menu-getrow');
        Route::post('destroy', 'Menu@destroy')->name('menu-destroy');

        Route::put('save', 'Menu@save')->name('menu-save');
    });

    // User Type
    Route::prefix('user-type')->group(function () {
        Route::get('/', 'Setting\UserType@main')->name('usertype-main');
        Route::get('index', 'Setting\UserType@index')->name('usertype-index');
        Route::get('usertype-add', 'Setting\UserType@add')->name('usertype-add');
        Route::get('usertype-edit/{id}', 'Setting\UserType@edit')->name('usertype-edit');
        Route::get('usertype-user-access/{id}', 'Setting\UserType@userAccess')->name('usertype-user-access');

        Route::post('store', 'Setting\UserType@store')->name('usertype-store');
        Route::post('destroy', 'Setting\UserType@destroy')->name('usertype-destroy');
        Route::post('store-user-access', 'Setting\UserType@StoreUserAccess')->name('usertype-store-user-access');

        Route::put('save', 'Setting\UserType@save')->name('usertype-save');
    });

    // User
    Route::prefix('user')->group(function () {
        Route::get('/', 'Setting\User@main')->name('user-main');
        Route::get('index', 'Setting\User@index')->name('user-index');
        Route::get('user-add', 'Setting\User@add')->name('user-add');
        Route::get('user-edit/{id}', 'Setting\User@edit')->name('user-edit');
        Route::get('user-edit-profile', 'Setting\User@editProfile')->name('user-edit-profile');
        Route::get('edit-user-profile', 'Setting\User@userEditProfile')->name('edit-user-profile');
        Route::get('profile', 'Setting\User@profile')->name('user-profile');

        Route::post('store', 'Setting\User@store')->name('user-store');
        Route::post('destroy', 'Setting\User@destroy')->name('user-destroy');
        Route::post('upload-image', 'Setting\User@uploadImage')->name('user-upload-image');

        Route::put('save', 'Setting\User@save')->name('user-save');
    });


    // Apps
    Route::prefix('apps')->group(function () {
        Route::get('/', 'Setting\Apps@main')->name('apps-main');
        Route::get('index', 'Setting\Apps@index')->name('apps-index');

        Route::put('save', 'Setting\Apps@save')->name('apps-save');
    });
});

// Master Data
Route::prefix('master-data')->group(function () {
    // Class
    Route::prefix('class')->group(function () {
        Route::get('/', 'MasterData\Classes@main')->name('class-main');
        Route::get('index', 'MasterData\Classes@index')->name('class-index');
        Route::get('add', 'MasterData\Classes@add')->name('class-add');
        Route::get('edit/{id}', 'MasterData\Classes@edit')->name('class-edit');

        Route::post('store', 'MasterData\Classes@store')->name('class-store');
        Route::post('destroy', 'MasterData\Classes@destroy')->name('class-destroy');

        Route::put('save', 'MasterData\Classes@save')->name('class-save');
    });

    // Student
    Route::prefix('student')->group(function () {
        Route::get('/', 'MasterData\Student@main')->name('student-main');
        Route::get('index', 'MasterData\Student@index')->name('student-index');
        Route::get('add', 'MasterData\Student@add')->name('student-add');
        Route::get('edit/{id}', 'MasterData\Student@edit')->name('student-edit');

        Route::post('store', 'MasterData\Student@store')->name('student-store');
        Route::post('destroy', 'MasterData\Student@destroy')->name('student-destroy');
        Route::post('isduplicate', 'MasterData\Student@isDuplicate')->name('student-duplicate');
        Route::post('detail', 'MasterData\Student@getRow')->name('student-detail');
        Route::post('get-all-barcode', 'MasterData\Student@getAllBarcode')->name('student-getallbarcode');
        Route::post('get-student', 'MasterData\Student@getStudent')->name('student-getstudent');
        Route::post('upload-image', 'MasterData\Student@uploadImage')->name('student-upload-image');


        Route::put('save', 'MasterData\Student@save')->name('student-save');
    });
});

// Item Master Data
Route::prefix('item-master-data')->group(function () {
    // Supplier
    Route::prefix('supplier')->group(function () {
        Route::get('/', 'ItemMasterData\Supplier@main')->name('supplier-main');
        Route::get('index', 'ItemMasterData\Supplier@index')->name('supplier-index');
        Route::get('add', 'ItemMasterData\Supplier@add')->name('supplier-add');
        Route::get('edit/{id}', 'ItemMasterData\Supplier@edit')->name('supplier-edit');

        Route::post('store', 'ItemMasterData\Supplier@store')->name('supplier-store');
        Route::post('destroy', 'ItemMasterData\Supplier@destroy')->name('supplier-destroy');

        Route::put('save', 'ItemMasterData\Supplier@save')->name('supplier-save');
    });

    // Category
    Route::prefix('category')->group(function () {
        Route::get('/', 'ItemMasterData\Category@main')->name('category-main');
        Route::get('index', 'ItemMasterData\Category@index')->name('category-index');
        Route::get('add', 'ItemMasterData\Category@add')->name('category-add');
        Route::get('edit/{id}', 'ItemMasterData\Category@edit')->name('category-edit');

        Route::post('store', 'ItemMasterData\Category@store')->name('category-store');
        Route::post('destroy', 'ItemMasterData\Category@destroy')->name('category-destroy');

        Route::put('save', 'ItemMasterData\Category@save')->name('category-save');
    });

    // Item
    Route::prefix('item')->group(function () {
        Route::get('/', 'ItemMasterData\Item@main')->name('item-main');
        Route::get('index', 'ItemMasterData\Item@index')->name('item-index');
        Route::get('add', 'ItemMasterData\Item@add')->name('item-add');
        Route::get('edit/{id}', 'ItemMasterData\Item@edit')->name('item-edit');

        Route::post('get-item', 'ItemMasterData\Item@getItem')->name('item-getitem');
        Route::post('get-item-data', 'ItemMasterData\Item@getItemData')->name('item-getitemdata');
        Route::post('store', 'ItemMasterData\Item@store')->name('item-store');
        Route::post('destroy', 'ItemMasterData\Item@destroy')->name('item-destroy');

        Route::put('save', 'ItemMasterData\Item@save')->name('item-save');
    });
});

// Deposit
Route::prefix('deposit')->group(function () {
    Route::get('/', 'Deposit\Deposit@main')->name('deposit-main');
    Route::get('index', 'Deposit\Deposit@index')->name('deposit-index');
    Route::get('add/{stdId}', 'Deposit\Deposit@add')->name('deposit-add');
    Route::get('edit/{id}', 'Deposit\Deposit@edit')->name('deposit-edit');
    Route::get('detail/{stdId}', 'Deposit\Deposit@detail')->name('deposit-detail');

    Route::post('store', 'Deposit\Deposit@store')->name('deposit-store');
    Route::post('destroy', 'Deposit\Deposit@destroy')->name('deposit-destroy');

    Route::put('save', 'Deposit\Deposit@save')->name('deposit-save');
});

// Transaction
Route::prefix('transaction')->group(function () {
    Route::get('/', 'Transaction\Transaction@main')->name('transaction-main');
    Route::get('index', 'Transaction\Transaction@index')->name('transaction-index');
    Route::get('add', 'Transaction\Transaction@add')->name('transaction-add');
    Route::get('payment', 'Transaction\Transaction@payment')->name('transaction-payment');
    Route::get('edit/{id}', 'Transaction\Transaction@edit')->name('transaction-edit');

    Route::post('store', 'Transaction\Transaction@store')->name('transaction-store');
});

// Report
Route::prefix('report')->group(function () {
    // Report of income
    Route::prefix('report-of-income')->group(function () {
        Route::get('/', 'Report\ReportIncome@main')->name('report-income-main');
        Route::get('index', 'Report\ReportIncome@index')->name('report-income-index');
        Route::get('export/{dateFrom}/{dateTo}', 'Report\ReportIncome@export')->name('report-income-export');
        Route::get('get-list-income', 'Report\ReportIncome@getListIncome')->name('report-income-getlist');

        Route::post('get-data-income', 'Report\ReportIncome@getDataIncome')->name('report-income-getdata');
    });

    // Customer Report Transaction
    Route::prefix('customer-report-transaction')->group(function () {
        Route::get('/', 'Report\CustomerReport@main')->name('customer-report-main');
        Route::get('index', 'Report\CustomerReport@index')->name('customer-report-index');
        Route::get('export/{dateFrom}/{dateTo}', 'Report\CustomerReport@export')->name('customer-report-export');
        Route::get('get-list-income', 'Report\CustomerReport@getListIncome')->name('customer-report-getlist');

        Route::post('get-data-income', 'Report\CustomerReport@getDataIncome')->name('customer-report-getdata');
    });

    // Supplier Report
    Route::prefix('supplier-report')->group(function () {
        Route::get('/', 'Report\SupplierReport@main')->name('supplier-report-main');
        Route::get('index', 'Report\SupplierReport@index')->name('supplier-report-index');
        Route::get('export/{dateFrom}/{dateTo}/{supplierId}', 'Report\SupplierReport@export')->name('supplier-report-export');
        Route::get('get-list-supplier', 'Report\SupplierReport@getListSupplier')->name('supplier-report-getlist');

        Route::post('get-data-supplier', 'Report\SupplierReport@getDataSupplier')->name('supplier-report-getdata');
    });
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// ERROR PAGE
Route::get('403', function() {
    return view('error-page.page_403');
} )->name('error-403');

Route::get('404', function() {
    return view('error-page.page_404');
} )->name('error-404');
