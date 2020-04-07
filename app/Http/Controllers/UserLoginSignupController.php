<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Userdetail;
use App\Otp;
use App\emailtoken;
use Illuminate\Support\Str;
use App\Mail\EmailVerification;
use App\Mail\ForgetPasswordLink;
use App\Mail\PasswordSendMail;
use App\resetpassword;
use Carbon\Carbon;
use App\Userintrest;
use App\Configuration;
use App\UserBehavior;

/*
    For Registration Status Code is: 600-650
    For Login Status Code is: 651-700
    For Verification OTP/ Resend OTP / Forget Password Status Code is: 701-750
    For Account related StatusCOde: 801-850


*/


class UserLoginSignupController extends Controller
{
    // Registration Controllerthrough email and password
    public function registration(Request $request)
    {
        // Validation the request data

        $validator = \Validator::make($request->all(), [ 
            'email' => 'required|unique:users', 
            'number' => 'required|integer|unique:users',
            'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        

        $emailtable = new emailtoken;
        $emailtoken = Str_random(100);
        $emailtable->token = $emailtoken;
        $emailtable->user_id = $user->id;
        $token = $emailtable->token;
        $emailtable->save();
        $mailsending = \Mail::to($user->email)->send(new EmailVerification($token));



        // $success['token'] =  $user->createToken('datingapp')->accessToken; 
        $success['message'] = "Please verify your email to countinue";
        $success['statuscode'] = 600;
        return response()->json(['success'=>$success]); 
    }

    // verify the email
    public function verifyemail($token)
    {
        $mins = Configuration::select("EMAIL_TOKEN_EXPIRE_TIME_IN_MIN")->first();
        //$mins = \env('EMAIL_TOKEN_EXPIRE_TIME_IN_MIN');
        $findtoken = emailtoken::where('token',$token)->first();
        
        // current date 
        $curtokentime = Carbon::now();
        //dd($curtokentime);

        // adding the days from env
        $usertokendate = $findtoken->created_at->addMinutes($mins->EMAIL_TOKEN_EXPIRE_TIME_IN_MIN);
        $check = $curtokentime <= $usertokendate;
        //dd($check, $curtokentime);

        if($check === true)
        {
            if($findtoken)
            {
                $verified = User::where('id',$findtoken->user_id)->update(['is_email_is_verified'=>'1'],['is_user_active'=>'1']);
                $user = User::where('id',$findtoken->user_id)->first();
                $success = [
                    "statuscode" => 701,
                    "message" =>"Email is verified",
                    "token" => $user->createToken('datingapp')->accessToken,
                ];
                return response()->json(["success"=>$success]);
            }   
            return response()->json(["error"=>"Invalid token please resend it"],401);
        }
        return response()->json(["success"=>"Email token is expired please resend it again"],702);
        
    }

    // Login Controller based on email
    public function loginthroughemailPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'email' => 'required|email',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            //dd($user->is_email_is_verified);
            if($user->is_email_is_verified == 1)
            {
                $success['token'] =  $user->createToken('datingapp')->accessToken; 
                $success['message'] = "successfully login to the system";
                $success['statuscode'] = 651;
                $success['user'] = $user;
                $success['userdetails'] = $user->userdetail;
                return response()->json(['success' => $success]); 
            }
            $success = [
                'statuscode'=>705,
                'message'=>"Please verify your email first",
            ];
            return response()->json(["success"=>$success],200);
            
        } 
        else{ 
            return response()->json(['error'=>'Invalid email or password'], 401); 
        } 
    }

    // resend email verification link

    public function resendemailverification(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'email' => 'required|email',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $email = User::where('email',$request->email)->first();
        if($email)
        {
            $emailtable = new emailtoken;
            $emailtoken = Str_random(100);
            $emailtable->token = $emailtoken;
            $emailtable->user_id = $email->id;
            $token = $emailtable->token;
            $emailtable->save();
            $mailsending = \Mail::to($email->email)->send(new EmailVerification($token));
            $success = [
                'statuscode'=>703,
                'message'=>'Email verification link is resend'
            ];
            return response()->json(["success"=>$success],200);
        }
        return response()->json(["error"=>"Email not found please register"],401);
    }

    // Login through mobile and password
    public function loginthroughmobile(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'number' => 'required|integer',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        if(Auth::attempt(['number' => request('number'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            //dd($user->is_email_is_verified);
            if($user->is_email_is_verified == 0)
            {
                $success['token'] =  $user->createToken('datingapp')-> accessToken; 
                $success['message'] = "successfully login to the system";
                $success['statuscode'] = 652;
                $success['user'] = $user;
                $success['userdetails'] = $user->userdetail;
                return response()->json(['success' => $success],200); 
            }
            $success = [
                'statuscode'=>705,
                'message'=>"Please verify your email first",
            ];
            return response()->json(["success"=>$success],200);
            
        } 
        else{ 
            return response()->json(['error'=>'Invalid email or password'], 401); 
        }
    }


    // login through mobile otp
    public function loginthroughotp(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'number' => 'required|integer',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = User::where('number',$request->number)->first();
        if($user)
        {
            // if(Otp::where('user_id',$user->id)->first())
            // {
            //     return response()->json(["success"=>"You have already sent this or resend by going to the down link"],200);
            // }

            $otp = \random_int(10000,99999);
            //dd($otp);
            $input = $request->all();
            $input['user_id'] = $user->id;
            $input['otp_is_for'] = 'login';
            $input['otp'] = $otp;
            $otptable = Otp::create($input);

            $success = [
                'statuscode'=>710,
                'message'=>"OTP is send successfull",
            ];
            return response()->json(["success"=>$success],200);
        }
        return response()->json(["success"=>"please register with us number not found"],401);        
    }

    public function verifyotp(Request $request)
    {
        $mins = Configuration::select("OTP_EXPIRE_TIME_IN_MIN")->first();
        // $mins = \env('OTP_EXPIRE_TIME_IN_MIN');
        $getotp = Otp::where('otp',$request->otp)->first();
        //dd($mins->OTP_EXPIRE_TIME_IN_MIN);

        if($getotp)
        {
            $curtokentime = Carbon::now();
            $usertokendate = $getotp->created_at->addMinutes($mins->OTP_EXPIRE_TIME_IN_MIN);
            $check = $curtokentime <= $usertokendate;
            //dd($usertokendate);
            if($check === true)
            {
                $user = User::where('id',$getotp->user_id)->first();
                if($user->is_user_active == 0)
                {
                    $success = [
                        'statuscode'=>801,
                        'message'=>"Opps your account is deactivated if it's not you please contact admin",
                    ];
                    return response()->json(["success"=>$success],200);
                }

                if($getotp->is_otp_used == 1)
                {
                    $success = [
                        'statuscode'=>704,
                        'message'=>"OTP is already used, Please resend it again"
                    ];
                    return response()->json(["success"=>$success],200);
                }

                if($getotp->otp == $request->otp)
                    {
                        User::where('id',$getotp->user_id)->update(['is_number_is_verified'=>'1']);
                        Otp::where('otp',$getotp->otp)->update(['is_otp_used'=>'1']);

                        $lastlogincheck = UserBehavior::where('user_id',$user->id)->first();
                        if($lastlogincheck == NULL)
                        {
                            $ub = new UserBehavior;
                            $ub->user_id = $user->id;
                            $ub->last_login = Carbon::now();
                            $ub->save();
                        }
                        else
                        {
                            UserBehavior::where('user_id',$user->id)->update([
                                'user_id' => $user->id,
                                'last_login' => Carbon::now(),
                            ]);
                        }

                        //dd($getotp->user_id);
                        $success = [
                            'statuscode'=>653,
                            'message'=>"User is successfully Verified",
                            'token'=>$user->createToken('datingapp')->accessToken,
                        ]; 
                        return response()->json(["success"=>$success],200);
                    }
                    $success = [
                        'statuscode'=>706,
                        'message'=>"Entered OTP is wrong"
                    ];
                    return response()->json(["success"=>$success],200);
            }
            $getotp->delete();
            $success = [
                'statuscode'=>707,
                'message'=>"OTP expired please resend it again",
            ];
            return response()->json(["success"=>$success],200);
        }
        $success = [
            'statuscode'=>708,
            'message'=>"OTP not found",
        ];
        return response()->json(["success"=>$success],404);
        
    }

    public function resendotp(Request $request)
    {
        $user = User::where('number',$request->number)->first();
        if($user)
        {   
            $otp = \random_int(10000,99999);
            //dd($otp);
            $input = $request->all();
            $input['user_id'] = $user->id;
            $input['otp_is_for'] = 'login';
            $input['otp'] = $otp;
            $otptable = Otp::create($input);
            //Otp::where('user_id',$user->id)->first()->delete();
            $success = [
                'statuscode'=>710,
                'message'=>"OTP is send successfull"
            ];
            return response()->json(["success"=>$success],200);
        }
        $success = [
            'statuscode'=>711,
            'message'=>"please register with us number not found",
        ];
        return response()->json(["success"=>$success],401);   
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        dd($user);
        if($user)
        {
            UserBehavior::where('user_id',$user->id)->update([
                'user_id' => $user->id,
                'last_login' => Carbon::now()
            ]);

            $user->revoke();
            $success = [
                'statuscode'=>1000,
                'message'=>"Logout Successfull",
            ];
            return response()->json(["success"=>$success],200);
        }
        $success = [
            'statuscode'=>401,
            'message'=>"Unauthorize User"
        ];
        return response()->json(["success"=>$success],200);
    }


    public function forgetpasswordlink(Request $request)
    {
        $gettinguser = User::where('email',$request->email)->first();
        if($gettinguser)
        {
            $passreset = new resetpassword;
            $passtoken = Str_random(100);
            $passreset->token = $passtoken;
            $passreset->user_id = $gettinguser->id;
            $passreset->save();
            $token = $passreset->token;
            $mailsending = \Mail::to($gettinguser->email)->send(new ForgetPasswordLink($token));
            return response()->json(["success"=>"We have mailed you a link on ".$gettinguser->email. " please reset it."],200);
        }
        return response()->json(["success"=>"Email is not found please register"],200);
    }

    public function forgetpassword($token)
    {
        //dd($token);
        $findtoken = resetpassword::where('token',$token)->first();
        if($findtoken)
        {
            $finduser = User::where('id',$findtoken->user_id)->first();
            if($finduser)
            {
                
                $random = str_random(10);
                $password = $random;
                $passwordgen = bcrypt($random);
                User::where('id',$finduser->id)->update([
                    'password'=>$passwordgen,
                ]);
                $success['message'] = "Please check your mail we have reset your password and given you a temp password for login ";
                $success['statuscode'] = 600;
                \Mail::to($finduser->email)->send(new PasswordSendMail($password));
                return response()->json(['success' => $success]); 
            }
            return response()->json(["success"=>"Something went wrong try again later"],200);
        }
        return response()->json(["success"=>"Invalid token"],200);
    }

    public function updatepassword(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            $input = $request->all(); 
            $bypass = bcrypt($input['password']); 
            User::where('id',$user->id)->update([
                'password'=> $bypass
            ]);
            $user->token()->revoke();

            return response()->json(["success"=>"Password updated successfully please redirect with to login screen"],200);
        }
        // return response()->json(["success"=>"Please login to the system"],401);
    }

    // we can combine it with loginthroughmobile
    public function registrationandLoginThroughMobile(Request $request)
    {
        // checking where number is there in DB or not if yes then generate a OTP for login else go on validation

        $findnumber = User::where('number',$request->number)->first();
        if($findnumber)
        {
            $validator = \Validator::make($request->all(), [ 
                'number' => 'required|integer',  
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }


            $otp = \random_int(10000,99999);
            $input = $request->all();
            $input['user_id'] = $findnumber->id;
            $input['otp_is_for'] = 'Login';
            $input['otp'] = $otp;
            $otptable = Otp::create($input);

            $success = [
                'statuscode'=>710,
                'message'=>"OTP is send successfull",
            ];
            return response()->json(["success"=>$success],200);
        }

        $validator = \Validator::make($request->all(), [ 
            'number' => 'required|integer|unique:users',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $user = new User;
        $user->number = $request->number;
        $user->is_user_active = 1;
        $user->save();
        if($user)
        {
            $otp = \random_int(10000,99999);
            $input = $request->all();
            $input['user_id'] = $user->id;
            $input['otp_is_for'] = 'Registration';
            $input['otp'] = $otp;
            $otptable = Otp::create($input);

            $success = [
                'statuscode'=>710,
                'message'=>"OTP is send successfull",
            ];
            return response()->json(["success"=>$success],200);
        }
        $success = [
            'statuscode'=>900,
            'message'=>"Opps something went wrong",
        ];
        return response()->json(["success"=>$success],200);
    }

    // public function loginandRegistrationThroughEmail(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [ 
    //         'email' => 'required|email|unique:users',  
    //     ]);
    //     if ($validator->fails()) { 
    //         return response()->json(['error'=>$validator->errors()], 401);            
    //     }

    //     $user = User::where('email',$request->email)->first();
    //     if($user)
    //     {
    //         $emailtable = new emailtoken;
    //         $emailtoken = Str_random(100);
    //         $emailtable->token = $emailtoken;
    //         $emailtable->user_id = $user->id;
    //         $token = $emailtable->token;
    //         $emailtable->save();
    //         $mailsending = \Mail::to($user->email)->send(new EmailVerification($token));

    //         return response()->json(["success"=>"If found your Email you'll receive a verification link"],200);
    //     }

    //     $email = $request->email;
    //     $user = new User;
    //     $user->email = $email;
    //     $user->save();

    //     $emailtable = new emailtoken;
    //     $emailtoken = Str_random(100);
    //     $emailtable->token = $emailtoken;
    //     $emailtable->user_id = $user->id;
    //     $token = $emailtable->token;
    //     $emailtable->save();
    //     $mailsending = \Mail::to($user->email)->send(new EmailVerification($token));

    //     return response()->json(["success"=>"If found your Email you'll receive a verification link"],200);

    // }

    public function userinterest(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            $ui = new Userintrest;
            $ui->user_id = $user->id;
            $ui->min_age = $request->min_age;
            $ui->max_age = $request->max_age;
            $ui->distance = $request->distance;
            $ui->looking_for = $request->looking_for;
            $ui->orientation = $request->orientation;
            $ui->save();
            
            if($ui)
            {
                $success = [
                    'statuscode'=>603,
                    'message'=>"Interest saved successfully"
                ];
                return response()->json(["success"=>$success],200);
            }
            $success = [
                'statuscode'=>900,
                'message'=>"Opps something went wrong in execution",
            ];
            return response()->json(["success"=>$success],200);
        }
        else
        {
            // $success = [
            //     'statuscode'=>401,
            //     'message'=>"Unauthorize Access",
            // ];
            // return response()->json(["success"=>$success],401);
        }
       
    }

}

