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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminlogin',function(){
    return view('admin/adminlogin');
});

Route::get('/admindashboard','AdminController@dashboard')->middleware('session');

Route::post('/admin','AdminController@adminLogin');

Route::get('/adminlogout','AdminController@logout');
Route::put('/changepassword','AdminController@changepassword')->middleware('session');
Route::get('/changepassword',function(){
    return view('admin.adminchangepassword');
})->middleware('session');

// profile CURD
Route::get('/addprofile',function(){
    return view('admin.profile');
})->middleware('session');
Route::post('/addprofileadd','AdminController@addProfileToBeShown')->middleware('session');
Route::get('/showprofile','AdminController@showprofile')->middleware('session');
Route::delete('/deleteprofile/{id}','AdminController@deleteprofile')->middleware('session');
Route::get('/editprofile/{id}', 'AdminController@editprofile')->middleware('session');
Route::put('/updateprofile/{id}','AdminController@updateprofile')->middleware('session');

// configuration CURD
Route::get('/showconfiguration','AdminController@showallconfiguration')->middleware('session');
Route::get('/addconfiguration',function(){
    return view('admin.configuration');
})->middleware('session');
Route::post('/addconfig','AdminController@addOTPEmailExpiration')->middleware('session');
Route::put('/updateconfiguration','AdminController@updateconfiguration')->middleware('session');
Route::get('/editconfiguration/{id}','AdminController@editconfiguration')->middleware('session');
Route::put('/updateconfiguration/{id}','AdminController@updateconfiguration')->middleware('session');

Route::get('/logout','AdminController@logout')->middleware('session');


// slotting CURD operation
Route::get('/addslotting',function(){
    return view('admin.addslotting');
})->middleware('session');
Route::get('/showallslots','AdminController@allslots')->middleware('session');
Route::post('/addslottingonprofile','AdminController@addSlottingOnProfile')->middleware('session');
Route::get('/editslots/{id}','AdminController@editslots')->middleware('session');
Route::put('/updateslot/{id}','AdminController@updateslot')->middleware('session');
Route::delete('/deleteslots/{id}','AdminController@deleteslots')->middleware('session');

// Superlike Package List
Route::get('/superlikepckglist','AdminController@showsuperlikelist')->middleware('session');
Route::get('/addsuperlikepackage',function(){
    return view('admin.addsuperlikepackage');
})->middleware('session');
Route::post('addsuperlikepckg','AdminController@addsuperlikepckg')->middleware('session');
Route::get('/editsuperlikepckg/{id}','AdminController@editsuperlikepckg')->middleware('session');
Route::put('/updatesuperlikepckg/{id}','AdminController@updatesuperlikepckg')->middleware('session');
Route::delete('/deletesuperlikepckg/{id}','AdminController@deletesuperlikepckg')->middleware('session');

// Boosts CURD
Route::get('/addboosts',function(){
    return view('admin.addboosts');
})->middleware('session');
Route::get('/showallboosts','AdminController@showboostslist')->middleware('session');
Route::post('/addboostsepckg','AdminController@addboostsepckg')->middleware('session');
Route::get('/editboostspckg/{id}','AdminController@editboostspckg')->middleware('session');
Route::put('/updateboostspckg/{id}','AdminController@updateboostspckg')->middleware('session');
Route::delete('/deleteboostspckg/{id}','AdminController@deleteboostspckg')->middleware('session');

// Hidden Profile CURD
Route::get('/addhiddenprofilepck',function(){
    return view('admin.addhiddenprofilepck');
})->middleware('session');
Route::get('/showallhiddenprofile','AdminController@showallhiddenprofile')->middleware('session');
Route::post('/addhiddenprofilepck','AdminController@addhiddenprofilepck')->middleware('session');
Route::get('/edithiddenprofilepck/{id}','AdminController@edithiddenprofilepck')->middleware('session');
Route::put('/updatehiddenprofilepckg/{id}','AdminController@updatehiddenprofilepckg')->middleware('session');
Route::delete('/deletehiddenprofilespckg/{id}','AdminController@deletehiddenprofilespckg')->middleware('session');

// StringsGo CURD
Route::get('/addstringsgopck',function(){
    return view('admin.addstringsgopck');
})->middleware('session');
Route::get('/showallstringsgopck','AdminController@showallstringsgopck')->middleware('session');
Route::post('/addstringgopck','AdminController@addstringgopck')->middleware('session');
Route::get('/editstringgopckg/{id}','AdminController@editstringgopckg')->middleware('session');
Route::put('/updatestringgopckg/{id}','AdminController@updatestringgopckg')->middleware('session');
Route::delete('/deletestringsgopckg/{id}','AdminController@deletestringsgopckg')->middleware('session');

// User Section of admin dashboard
Route::get('/alluserslist','AdminController@userslist')->middleware('session');
Route::get('/viewuser/{id}','AdminController@viewuser')->middleware('session');
Route::get('/deactivateuser/{id}','AdminController@deactivateuser')->middleware('session');
Route::get('/activateuser/{id}','AdminController@activateuser')->middleware('session');