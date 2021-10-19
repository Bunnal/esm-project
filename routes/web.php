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

Route::get('/index', function () {
    return view("index");
});
Route::group(['prefix' => 'emspro','middleware' => ['auth']], function (){
    Route::get('/','MainController@index')->name('home');
    //Eleave
    Route::get('/eleave','Eleave\EleaveController@index')->name('eleave');
    //LeaveTake
    Route::get('/leave','Eleave\LeaveTakeController@index')->name('leave');
    Route::get('/leave/create','Eleave\LeaveTakeController@create')->name('createleave');
    Route::post('/leave/store','Eleave\LeaveTakeController@store')->name('storeleave');
    Route::get('/leave/show/{id}','Eleave\LeaveTakeController@show')->name('showleave');
    Route::get('/leave/edit/{id}','Eleave\LeaveTakeController@edit')->name('editleave');
    Route::post('/leave/update/{id}','Eleave\LeaveTakeController@update')->name('updateleave');
    Route::get('/leave/delete/{id}','Eleave\LeaveTakeController@destroy')->name('deleteleave');
    Route::get('autocomplete', 'Eleave\LeaveTakeController@autocomplete')->name('autocomplete');
    Route::post('/leave/update_sup_approval/{id}','Eleave\LeaveTakeController@update_sup_approval')->name('update_sup_approval');
    Route::post('/leave/update_hod_approval/{id}','Eleave\LeaveTakeController@update_hod_approval')->name('update_hod_approval');
    Route::post('/leave/update_hoj_approval/{id}','Eleave\LeaveTakeController@update_hoj_approval')->name('update_hoj_approval');

     //LeaveApproval
     Route::get('/leaveapproval','Eleave\LeaveApprovalController@index')->name('leaveapproval');
     Route::get('/leaveapproval/show/{id}','Eleave\LeaveApprovalController@show')->name('showapproved');
     Route::get('/leaveapproval/delete/{id}','Eleave\LeaveApprovalController@destroy')->name('deleteleaveapproval');
     //Balances
     Route::get('/ownbalance','Eleave\BalanceController@index')->name('ownbalance');
     Route::post('/getownbalance','Eleave\BalanceController@getOwnBalance')->name('getownbalance');
     Route::get('/balancebymonth','Eleave\BalanceController@balanceByMonth')->name('balancebymonth');
     Route::post('/getbalancebymonth','Eleave\BalanceController@getBalanceByMonth')->name('getbalancebymonth');
     Route::get('/balancebymonth/show/{id}','Eleave\LeaveTakeController@show')->name('showbalancebymonth');
 
     //report
     Route::get('/report','Eleave\ReportController@index')->name('report');
     Route::post('/allstaff','Eleave\ReportController@search')->name('allstaff');
     Route::get('/getbyusername','Eleave\ReportController@getByUserName')->name('getbyusername');
     Route::post('/searchbyusername','Eleave\ReportController@searchByUserName')->name('searchbyusername');
     Route::get('/getbyleavetype','Eleave\ReportController@getByLeaveType')->name('getbyleavetype');
     Route::post('/searchbyleavetype','Eleave\ReportController@searchByLeaveType')->name('searchbyleavetype');
     Route::get('/getbynevertakeleave','Eleave\ReportController@getByNeverTakeLeave')->name('getbynevertakeleave');
     Route::post('/nevertakeleave','Eleave\ReportController@searchByNeverTakeLeave')->name('nevertakeleave');
     Route::get('/getbytotalleave','Eleave\ReportController@getByTotalLeave')->name('getbytotalleave');
     Route::post('/searchbytotalleave','Eleave\ReportController@searchByTotalLeave')->name('searchbytotalleave');
     Route::get('/viewalluser','Eleave\ReportController@viewAllUser')->name('viewalluser');
     Route::get('/viewuserleave/{id}','Eleave\ReportController@viewUserLeave')->name('viewuserleave');

    //LeaveDisapproval
    Route::get('/leavedisapproval','Eleave\LeaveDisapprovalController@index')->name('leavedisapproval');
    Route::get('/leavedisapproval/show/{id}','Eleave\LeaveDisapprovalController@show')->name('showdisapproved');
    Route::post('/leavedisapproval/updatedisapproval/{id}','Eleave\LeaveDisapprovalController@updateDisapproval')->name('updatedisapproval');
    Route::get('/leavedisapproval/delete/{id}','Eleave\LeaveDisapprovalController@destroy')->name('deleteleavedisapproval');
});

// login
Route::post('/login/action','LoginController@loginAction')->name('login.action');
Route::get('/logout','LoginController@logOut')->name('logout');
