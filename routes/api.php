<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/userregistration','UserLoginSignupController@registration');

Route::get('/verifyemail/{token}','UserLoginSignupController@verifyemail');

Route::post('/loginthroughemail','UserLoginSignupController@loginandRegistrationThroughEmail');

Route::post('/login','UserLoginSignupController@loginthroughemailPassword');

Route::post('/resendemailverification','UserLoginSignupController@resendemailverification');

Route::post('/loginthroughmobile','UserLoginSignupController@loginthroughmobile');

Route::post('/loginthroughotp','UserLoginSignupController@loginthroughotp');

Route::get('/verifyotp','UserLoginSignupController@verifyotp');

Route::get('/resendotp','UserLoginSignupController@resendotp');

Route::middleware('auth:api')->group(function(){

    Route::get('/dashboard','UserProfileController@dashboard');
    Route::get('/logout','UserLoginSignupController@logout');
    Route::post('/filluserdetails','UserProfileController@filluserdetails');
    Route::post('/updatepassword','UserLoginSignupController@updatepassword');
    Route::put('/updateuserdetails','UserProfileController@updateuserdetails');
    Route::get('/userprofilelist','UserProfileController@userlist');
    Route::get('/userswipe/{id}','UserProfileController@userLike');
    Route::get('/showliketype','UserProfileController@showUserLikedType');
    Route::get('/matchingProfileOfUsers','UserProfileController@matchingProfileOfUsers');
    Route::post('/updatenumber','UserProfileController@updateNumber');
    Route::post('/filluserinterest','UserLoginSignupController@userinterest');
    Route::post('/reportuser/{id}','UserAccountController@reportUser');
    Route::get('/deactivateaccount','UserAccountController@deactivateAccount');
    Route::post('/test','UserProfileController@addProfilePhotos');
    Route::put('/updatephotos/{id}','UserProfileController@updateProfiePicture');
    Route::get('/displayUserImage','UserProfileController@displayUserImage');
    Route::delete('/deleteProfilePhotos/{id}','UserProfileController@deleteProfilePhotos');
    Route::put('/blockuser/{id}','UserAccountController@blockUser');
    Route::post('/addimages','UserProfileController@addUserImages');
    Route::delete('/deleteme','UserAccountController@deleteMyAccount');
    Route::post('/referafriend','UserProfileController@userReferCode');
    Route::get('/age','UserLoginSignupController@calculateage');
    Route::get('/boostspck','UserAccountController@boostList');
    Route::get('/superlikepck','UserAccountController@superlikeList');
    Route::get('/hiddenprofilepck','UserAccountController@');
    Route::get('/stringgopck','UserAccountController@');
    Route::post('/buyboosts/{id}','UserAccountController@buyBoosts');
    Route::post('/buysuperlike/{id}','UserAccountController@buySuperlike');
    Route::get('/userpaymenthistory','UserAccountController@userPaymentHistory');
    Route::get('/cancelbootssubs/{id}','UserAccountController@cancelBoostsSubs');
    Route::get('/cancelsuperlikesubs/{id}','UserAccountController@cancelSuperlikeSubs');
    Route::post('/iwilliwillnot','UserProfileController@illiwillnot');
    Route::get('/unblockuser/{id}','UserAccountController@unblockUser');
});

Route::post('/mobileregistration','UserLoginSignupController@registrationandLoginThroughMobile');

Route::get('login/google', 'GoogleRegisterController@redirectToProvider');
Route::get('login/google/callback', 'GoogleRegisterController@handleProviderCallback');

Route::get('login/facebook', 'FacebookRegisterController@redirectToProvider');
Route::get('login/facebook/callback', 'FacebookRegisterController@handleProviderCallback');

Route::get('/forgetpasswordlink','UserLoginSignupController@forgetpasswordlink');

Route::get('/forgetpassword/{token}','UserLoginSignupController@forgetpassword');

