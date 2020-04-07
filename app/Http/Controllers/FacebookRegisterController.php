<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Mail\PasswordSendMail;
use App\User;
use Auth;
use App\Userimage;

class FacebookRegisterController extends Controller
{
    //
    //
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        // Validation the request data
        $user = Socialite::driver('facebook')->user();
        $usercreate = new User;
        $emailvalidate = User::where('email',$user->email)->first();
        if(($emailvalidate))
        {
            $loginuser = Auth::loginUsingId($emailvalidate->id);
            $success['statuscode'] = 600;
            $success['message'] = "successfully login with Facebook";
            $success['user'] = $loginuser;
            $success['token'] =  $loginuser->createToken('datingapp')->accessToken; 
            return response()->json(['success' => $success]); 
        }
        
        $usercreate->email = $user->email;
        $usercreate->is_user_active = 1;
        $usercreate->save();
        if($user->avatar)
        {
            $ui = new Userimage;
            $ui->image_name = $user->avatar;
            $ui->user_id = $usercreate->id;
            $ui->save();
        }
        $loginuser = Auth::loginUsingId($usercreate->id);
        $success['statuscode'] = 600;
        $success['message'] = "successfully Register with Facebook";
        $success['user'] = $loginuser;
        $success['token'] =  $loginuser->createToken('datingapp')->accessToken; 
        return response()->json(['success' => $success]); 
    }
}
