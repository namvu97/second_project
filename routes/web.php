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
Route::get('login', "LoginController@getLogin");
Route::post('login', "LoginController@postLogin");
Route::group(array('middleware' => 'checkLogin'), function() {
    Route::get('/', "AdminController@getMaster");
    Route::get('registry', "RegisterController@getRegister");
    Route::post('registry', "RegisterController@postRegister");
    Route::get('registry/{token}', "VerificationController@getVerify");
});

Route::group(array('middleware' => 'checkLogon'), function() {
    Route::get('logout', "LogoutController@getLogout");
    Route::get('home', "AdminController@getHome");
    Route::get('info', "AdminController@getInfoUser");
});

//Group with tag password
Route::group(array("prefix" => "password"), function() {
    Route::get('change', "ChangePasswordController@getChangePassword");
    Route::post('change', "ChangePasswordController@postChangePassword");
    Route::get('find', "ForgotPasswordController@getPassword")->middleware('checkLogin');
    Route::post('find', "ForgotPasswordController@postPassword");
    Route::post('reset', "ResetPasswordController@resetPassword");
});

//Group with tag admin/wallet
Route::group(array("prefix" => "admin/wallet", 'middleware' => 'checkLogon'), function() {
    Route::get("/", "WalletController@listWallet");
    Route::get("add", "AddEditWalletController@addWallet");
    Route::post("add", "AddEditWalletController@doAddWallet");
    Route::get("edit/{id}", "AddEditWalletController@editWallet");
    Route::post("edit/{id}", "AddEditWalletController@doEditWallet");
    Route::get("delete/{id}", "WalletController@deleteWallet");
    Route::get("transfer", "TransferWalletController@transferWallet");
    Route::post("transfer", "TransferWalletController@doTransferWallet");
});

//Group with tag admin/category
Route::group(array("prefix" => "admin/category", 'middleware' => 'checkLogon'), function() {
    Route::get("/", "CategoryController@listCategory");
    Route::get("add", "AddEditCategoryController@addCategory");
    Route::post("add", "AddEditCategoryController@doAddCategory");
    Route::get("edit/{id}", "AddEditCategoryController@editCategory");
    Route::post("edit/{id}", "AddEditCategoryController@doEditCategory");
    Route::get("delete/{id}", "CategoryController@deleteCategory");
});

//Group with tag admin/transaction
Route::group(array("prefix" => "admin/transaction", 'middleware' => 'checkLogon'), function() {
    Route::get("/{type}", "TransactionController@listTransaction");
    Route::get("/{type}/add", "AddEditTransactionController@addTransaction");
    Route::post("/{type}/add", "AddEditTransactionController@doAddTransaction");
    Route::get("/{type}/edit/{id}", "AddEditTransactionController@editTransaction");
    Route::post("/{type}/edit/{id}", "AddEditTransactionController@doEditTransaction");
    Route::get("/{type}/delete/{id}", "TransactionController@deleteTransaction");
    Route::get("/create/report", "CreateReportController@createReport");
});
