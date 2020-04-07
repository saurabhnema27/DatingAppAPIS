<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Mail\PasswordSendMail;
use App\User;
use Auth;

class GoogleRegisterController extends Controller
{
    //
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        // Validation the request data
        $user = Socialite::driver('google')->stateless()->user();
        //dd($user);
        $usercreate = new User;
        $emailvalidate = User::where('email',$user->email)->first();
        if(($emailvalidate))
        {
            $loginuser = Auth::loginUsingId($emailvalidate->id);
            $success['token'] =  $loginuser->createToken('datingapp')->accessToken; 
            $success['message'] = "successfully login";
            $success['statuscode'] = 600;
            $success['user'] = $loginuser;
            $success['userdetails'] = $loginuser->userdetail;
            return response()->json(['success' => $success]); 
        }
       // $random = str_random(10);
        //$passwordgen = bcrypt($random);
        //$password = $random;
        $usercreate->email = $user->email;
        $user->is_user_active = 1;
       // $usercreate->password = $passwordgen;
        //$usercreate->number = random_int(0,9);
        $usercreate->save();
        dd(Auth::loginUsingId($usercreate->id)->createToken('datingapp')->accessToken);
        // \Mail::to($user->email)->send(new PasswordSendMail($password));
        // return response()->json(["success"=>"Please check your mail and reset your password"],200);


    }
}
