<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Userdetail;
use App\Like;
use App\Userintrest;
use App\Userimage;
use App\UserLocation;
use App\UserRefer;
use App\refercode_used_by_user as rfubu;
use Carbon\Carbon;
use App\UserBehavior as ub;
use App\user_swiping_pattern as usp;
use App\profile_display;
use App\slotting_done_on_profile;
use App\UserSlots;
use App\user_superlike;
use App\iwilliwillnot;
use App\user_slot;


/*
    Profile related statuscode: 751-766
    Common error: 900-950

*/

class UserProfileController extends Controller
{
    //
    // fill details profile for user's
    public function filluserdetails(Request $request)
    {
        // validators to fill the user details

        $validator = \Validator::make($request->all(), [ 
            'first_name' => 'required|string', 
            'last_name' => 'required|string',
            'dob' => 'required',  
            'user_name'=>'string|unique:userdetails',
            'gender'=>'required',
            'bio'=>'required|string',

        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = Auth::user();
        if($user)
        {
            $check = Userdetail::where('user_id',$user->id)->first();
            if($check)
            {
                $success = [
                    'statuscode'=>760,
                    'message'=>"user details is already present please update if you want to change your profile details",
                ];
                return response()->json(["success"=>$success],200);
            }
            $code = Str_random(6);
            $ur = new UserRefer;
            $ur->user_id = $user->id;
            $ur->refer_code = $request->first_name.$code;
            $ur->save();

            $dob = $request->dob;
            $today = Carbon::now();
            $age = $today->diffInYears($dob);

            $input = $request->all();
            $input['user_id'] = $user->id;
            $input['age'] = $age;
            $input['dob'] = Carbon::parse($request->dob);
            $userdetails = Userdetail::create($input);
            if($userdetails)
            {
                $success = [
                    'statuscode'=>751,
                    'message'=>"user details is saved successfully",
                ];
                return response()->json(["success"=>$success],200);
            }
            $success = [
                'statuscode'=>900,
                'message'=>"opps something went wrong"
            ];
            return response()->json(["error"=>$success],200);
        }
        return response()->json(["success"=>"Invalid or Unauthorize user"],401);
    }
    
    // User profile update Controller. 
    // public function updateuserdetails(Request $request)
    // {
    //     $user = Auth::user();
    //     if($user)
    //     {
    //         $user->update($request->all());
    //         return response()->json(["success"=>"User details is updated successfully"],200);
    //     }
    //     return response()->json(["success"=>"please login to the system "],401);
    // }

    public function userLike(Request $request,$id)
    {
        $user = Auth::user();
        //dd($user);

        #superliked allowed
        $SUPERLIKE_ALLOWED = \env("SUPERLIKE_ALLOWED");

        $upgsuplke = user_superlike::where('user_id',$user->id)->first();
        //dd($upgsuplke->count_superlike);
        if($upgsuplke)
        {
            $curtokentime = Carbon::now();
            $usertokendate = $upgsuplke->created_at->addDays($upgsuplke->valid_till);
            $check = $curtokentime <= $usertokendate;
            //dd($check,$curtokentime,$usertokendate );
            if($check != true)
            {
                $upgsuplke->where('created_at',$upgsuplke->created_at)->update([
                    'is_expired' => 1
                ]);
            }
            if($upgsuplke->is_expired != 1)
            {
                $SUPERLIKE_ALLOWED = $SUPERLIKE_ALLOWED + $upgsuplke->count_superlike;
                //dd($SUPERLIKE_ALLOWED);
            }
            
        }

        #total liked profile to be displayed
        $TOTAL_LIKED_PROFILE_TO_BE_DISPLAYED = \env("TOTAL_LIKED_PROFILE_TO_BE_DISPLAYED");

        #fetchimg the profile for the like done by the login user
        $LikedUser = Userdetail::select('first_name')->where('user_id',$id)->first();

        #checking can he do swipe
        // $can_he_do_swipe = ub::select('can_he_do_swipe')->where('user_id',$user->id)->first();
        //dd($LikedUser);
        
        $liketype = $request->like_type;
        
        $countinglike = Like::where([
            ['like_type','like'],
            ['from_user_id',$user->id]
        ])->get()->count();
        
        $countingsl = Like::where([
            ['like_type','superlike'],
            ['from_user_id',$user->id]
        ])->get()->count();

        $countingdl = Like::where([
            ['like_type','dislike'],
            ['from_user_id',$user->id]
        ])->get()->count();

        // $savingub = ub::where('user_id',$user->id)->first();
        // if($savingub)
        // {
        //     ub::where('user_id',$user->id)->update([
        //         'total_like_type' => $countinglike,
        //         'total_dislike_type' => $countingdl,
        //         'total_superlike_type' => $countingsl,
        //     ]);
        // }

        // active user slot for a login user
        $activeuserslot = UserSlots::select('slot_id','created_at','profile_seen_by_user')->where([
            'user_id' => $user->id,
            'is_slot_shown' => '0'
        ])->first();
        
        //dd($activeuserslot->profile_seen_by_user );    

        // getting the profile displayed on slot
        $slotperofilenumber = slotting_done_on_profile::select('slot_number')->where('id',$activeuserslot->slot_id)->first();
        //dd($countinglike + $countingdl + $SUPERLIKE_ALLOWED < $slotperofilenumber->slot_number);
        
        if($user)
        {   
            if($liketype == 'like')
            {
                if($activeuserslot->profile_seen_by_user < $slotperofilenumber->slot_number)
                {
                    
                    //dd("commin in if block");
                    $liketable = new Like;
                    $liketable->like_type = $liketype;
                    $liketable->to_user_id = $id;
                    $liketable->from_user_id = $user->id;
                    $liketable->save();
                    $success = [
                        'statuscode'=> 763,
                        'message' => "success"." "."$liketype"." "."Done for "."$LikedUser->first_name"
                    ];
                    $activeuserslot = UserSlots::where([
                        'user_id' => $user->id,
                        'is_slot_shown' => '0'
                    ])->update(["profile_seen_by_user" =>$activeuserslot->profile_seen_by_user +1]);
                    return response()->json(["success"=>$success],200);
                }
                $updateslotforswipenextslot = UserSlots::where('created_at',$activeuserslot->created_at)->update([
                    'is_slot_shown' => '1'
                ]);
                $success = [
                    'statuscode'=>764,
                    'message'=>"Your slots is empty now"
                ];
                // $usrswpptrn = new usp;
                // $usrswpptrn->left_swipe_pattern = \str_repeat("R",$countinglike);
                // $usrswpptrn->user_id = $user->id;
                // $usrswpptrn->save();
                return response()->json(["success"=>$success],200);
            }
            elseif($liketype == "superlike")
            {
                if($countingsl < $SUPERLIKE_ALLOWED )
                {
                    $liketable = new Like;
                    $liketable->like_type = $liketype;
                    $liketable->to_user_id = $id;
                    $liketable->from_user_id = $user->id;
                    $liketable->save();
                    $success = [
                        'statuscode'=> 763,
                        'message' => "success"." "."$liketype"." "."Done for "."$LikedUser->first_name"
                    ];
                    $activeuserslot = UserSlots::where([
                        'user_id' => $user->id,
                        'is_slot_shown' => '0'
                    ])->update(["profile_seen_by_user" =>$activeuserslot->profile_seen_by_user +1]);
                    return response()->json(["success"=>$success],200);
                }
                
                $success = [
                    'statuscode'=>764,
                    'message'=>"Opps your free Superlike swipes are over for today please upgrade your account or refer any friend to get more"
                ];
                return response()->json(["success"=>$success],200);
            }

            elseif($liketype == "dislike")
            {
                if($activeuserslot->profile_seen_by_user < $slotperofilenumber->slot_number)
                {
                    $liketable = new Like;
                    $liketable->like_type = $liketype;
                    $liketable->to_user_id = $id;
                    $liketable->from_user_id = $user->id;
                    $liketable->save();
                    $success = [
                        'statuscode'=> 763,
                        'message' => "success"." "."$liketype"." "."Done for "."$LikedUser->first_name"
                    ];
                    $activeuserslot = UserSlots::where([
                        'user_id' => $user->id,
                        'is_slot_shown' => '0'
                    ])->update(["profile_seen_by_user" =>$activeuserslot->profile_seen_by_user +1]);
                    return response()->json(["success"=>$success],200);
                }
                $updateslotforswipenextslot = UserSlots::where('created_at',$activeuserslot->created_at)->update([
                    'is_slot_shown' => '1'
                ]);
                $success = [
                    'statuscode'=>764,
                    'message'=>"Your slots are empty now"
                ];
                return response()->json(["success"=>$success],200);
            }
            
        }
        return response()->json(["success"=>"Unauthorize User"],401);
    }
 

    public function showUserLikedType()
    {
        $user = Auth::user();
        //dd($user);
        if($user)
        {
            $userLikedTypes = $user->Like;
            //dd($userLikedTypes);
            $i=0;
            foreach($userLikedTypes as $ult)
            {
                //dd($userLikedTypes);
                $getusers[$i] = Userdetail::select('first_name')->where('id',$ult->to_user_id)->get();
                $i++;
            }           
            if(empty($getusers))
            {
                $success = [
                    'statuscode' => 762,
                    'message' => "You haven't swipe for any one"
                ];
                return response()->json(["success"=>$success],200);
            }
            $success = [
                'statuscode' => 761,
                'message'=> "Your liked list reterive successfully",
                "UserLikedList" => $userLikedTypes,
            ];
            return response()->json(["success"=>$success],200);
        }
        return response()->json(["success"=>"Unauthorize Access"],401);
    }

    public function matchingProfileOfUsers(Request $request)
    {
        // getting login user details
        $user = Auth::user();
        
        // getting like he done to other users
        $loginuserlikedlist = $user->Like;

        // Condition checking for Like User here
        $i=0;
        $likedpeople = array();
        foreach($loginuserlikedlist as $lull)
        {
            // getting the details of the users which he liked or superlike
            $getonebyonelike[$i] = Userdetail::where('user_id',$lull->to_user_id)->first();

            // testing a check where the other user liked him or not, to whome he liked
            $testcase[$i] = Like::where([
                ['from_user_id',$getonebyonelike[$i]->user_id],
                ['to_user_id',$user->id],
                ['like_type','Like'],
            ])->orWhere([
                ['from_user_id',$getonebyonelike[$i]->user_id],
                ['to_user_id',$user->id],
                ['like_type','Superlike'],
            ])->first();

            // checking where there is anyone or not who liked him or not 
            if(!empty($testcase))
            {
                $likedpeople[$i] = $testcase[$i];  
            }
            $i++;
        }

        $i=0;
        $getuser = array();

        // if someone liked him we're getting the details of the person over here in this loop
        foreach($likedpeople as $lp)
        {
            if(isset($lp->from_user_id))
            {
                $getuser[$i] = Userdetail::select('first_name','last_name','user_name')->where('user_id',$lp->from_user_id)->first();
            }
            $i++;
        }

        // if the users are empty we're checking the condition over here 
        if(empty($getuser) === true)
        {
            $success = [
                'statuscode' => 760,
                'message'=> "Opps no one swiped for you till now"
            ];
            return response()->json(["success"=>$success],200);
        }
        $success = [
            'statuscode' => 759,
            'Chat'=>"You can start chating",
            'LikedBackedBy'=> $getuser,
            'countofUserMatches'=> count($getuser),
        ];
        return response()->json(["Success"=>$success],200);
    }

    public function updateNumber(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            //$number = $user->number;
            $userUpdate->update($request->all());
            if($userUpdate)
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
        return response()->json(["success"=>"Unauthorize Access"],401);
    }

    
    public function deleteProfilePhotos($id)
    {
        $user = Auth::user();
        if($user)
        {
            $check = Userimage::where('id',$id)->first();
            if($check)
            {
                $check->delete();
                $success = [
                    'statuscode'=>758,
                    'message'=>"Image delete successfully"
                ];
                return response()->json(["success"=>$success],200);
            }
            else
            {
                $success = [
                    'statuscode'=>900,
                    'message'=>"Opps Image not found",
                ];
                return response()->json(["success"=>$success],200);
            }
        }
        $success = [
            'statuscode'=>401,
            'message'=>"Unauthorize Access"
        ];
        return response()->json(["success"=>$success],401);
    }

    public function displayUserImage()
    {
        $user = Auth::user();
        if($user)
        {
            $user_images = Userimage::select('image_name','id')->where('user_id',$user->id)->get();
            $success = [
                    'statuscode'=>757,
                    'message'=>"User Images Reterive Successfully",
                    'userimages'=>$user_images,
            ];
            return response()->json(["success"=>$success],200);
            
        }
        else
            return response()->json(["success"=>"Unauthorize User"],401);
        
    }

    public function updateProfiePicture(Request $request,$id)
    {
        $user = Auth::user();
        if($user)
        {
            $getid = Userimage::find($id);
            if(!$getid)
            {
                $success = [
                    'statuscode'=>755,
                    'message'=>"Image not found",
                ];
                return response()->json(["success"=>$success],404);
            }

            //dd($request->hasFile('user_img'));
            if($request->hasFile('user_img'))
            {
                    // Get filename with extension           
                    $filenameWithExt = $file->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                    // Get just extension
                    $extension = $file->getClientOriginalExtension();
                    //Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                    // Upload Image
                    \Storage::disk('public')->put($fileNameToStore, \File::get($request->user_img));

                    $image_data = array(
                        'image_name'=> $fileNameToStore,
                        'user_id' => Auth::user()->id,
                    );
                    // dd($image_data);
                    $test = Userimage::where('id',$id)->update($image_data);
            }
            $success = [
                'statuscode'=>754,
                'message'=>"Image is updated successfully",
            ];
            return response()->json(["success"=>$success],200);

        }
        else
        {
            $success = [
                'statuscode'=>401,
                'message'=>"Unauthorize Access",
            ];
            return response()->json(["success"=>$success],401);
        }
    }

    public function addUserImages(Request $request)
    {
        $user = Auth::user();
        // dd($request->all());
        if($user)
        {
            if($request->hasFile('user_img'))
            {
                
                // $filestobestore = array();
                foreach($request->file('user_img') as $file)
                {
                    // Get filename with extension           
                    $filenameWithExt = $file->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                    // Get just extension
                    $extension = $file->getClientOriginalExtension();
                    //Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                    // Upload Image
                    \Storage::disk('public')->put($fileNameToStore, \File::get($file));

                    $image_data = array(
                        'image_name'=> $fileNameToStore,
                        'user_id' => Auth::user()->id,
                    );
                    // dd($image_data);
                    Userimage::create($image_data);
                }
                $success = [
                    'statuscode'=>752,
                    'message'=>"Images store successfully",
                ];
                return response()->json(["success"=>$success],200);
            }
            $success = [
                'statuscode'=>753,
                'message'=>"Opps no images found in request",
            ];
            return response()->json(["success"=>$success],200);
        }
        else
        {
            $success = [
                'statuscode'=>401,
                'message'=>"Unauthorize Access",
            ];
            return response()->json(["success"=>$success],401);
        }
        
    }

    public function userReferCode(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            $gettingrefercode = $request->refer_code;

            $dbrefercode = UserRefer::where('refer_code',$gettingrefercode)->first();
            if($dbrefercode)
            {
               $rc = new rfubu;
               $rc->refer_code_used_by_user_id = $user->id;
               $rc->refer_id = $dbrefercode->id;
               $rc->save();

               return response()->json(["success"=>"Great you'll get a required benifits"],200);
            }
            return response()->json(["success"=>"ReferCode not found"],404);
        }
        return response()->json(["success"=>"Unauhtorize User"],401);
    }

    public function userlist()
    {
        $user = Auth::user();
        if($user)
        {
            // static filter
            $lat = Userdetail::select('latitude')->where('user_id',$user->id)->first();
            $lng = Userdetail::select('longitude')->where('user_id',$user->id)->first();

            // dynamic filter stage 1
            $gender = Userintrest::select('looking_for')->where('user_id',$user->id)->first();
            $min_age = Userintrest::select('min_age')->where('user_id',$user->id)->first();
            $max_age = Userintrest::select('max_age')->where('user_id',$user->id)->first();
            $dis =  Userintrest::select('distance')->where('user_id',$user->id)->first();
            $dis_in = Userintrest::select('distance_is_in')->where('user_id',$user->id)->first();
            //dd($gender,$min_age,$dis,$dis_in,$max_age);
            //$kmrad = $dis->distance/6371;
            //$milesinrad = $dis->distance/3959;

            //dd($profile);
            $userdata = array();
            $likeduser = array();
            $dislikeuser = array();
            //dd(isset($slots['0']));
           
            if($gender->looking_for != null)
            {
                //dd("yaha pe jaa raha hai");
                if($min_age->min_age != null && $max_age->max_age != null && $dis->distance != null)
                {
                    // first slot data 

                    if($dis_in->dis_in == 'km')
                    {
                        $userdata = Userdetail::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lng, $lat])
                        ->having('distance','<', 10000)
                        ->where('gender',$gender->looking_for)
                        ->whereBetween('age',[$min_age->min_age,$max_age->max_age])
                        ->get();
                    }
                    else
                    {
                        $userdata = Userdetail::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lng, $lat])
                        ->having('distance','<', 10000)
                        ->where('gender',$gender->looking_for)
                        ->whereBetween('age',[$min_age->min_age,$max_age->max_age])
                        ->get();
                    }
                }

                $userdata = Userdetail::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lng, $lat])
                ->having('distance','<', 10000)
                ->where('gender',$gender->looking_for)
                ->get();

                $userdata = $userdata; 

                $profile = profile_display::where('id','1')->first();
                
                if($profile == null)
                {
                    $success = [
                        'message' => "displaying profile on the bases of gender and looking for",
                        'userdata' => $userdata
                    ];
                    return response()->json(["success"=>$success],200);
                }

                // second slot data

               // dd($profile->slots_needed);
                if($profile->slots_needed != null || $profile->slots_needed != 0)
                {
                    $slots = slotting_done_on_profile::where('slot_sequence','1')->first();
                    //dd($slots);
                    $userslot = UserSlots::where('user_id',$user->id)->first();
                    // dd($userslot);
                    if($userslot === null || $userslot === NULL)
                    {
                        $crtslts = new UserSlots();
                        $crtslts->user_id = $user->id;
                        $crtslts->slot_id = $slots->id;
                        $crtslts->is_slot_shown = '0';
                        $crtslts->profile_seen_by_user = 0;
                        $crtslts->slot_date = Carbon::now();
                        $crtslts->save();

                        // displaying data after saving the slots.

                        // dd("data is saved and now displaying the data");
                        $likeduser = array();
                        $dislikeuser = array();
                        $i=0;
                        //dd(count($userdata));
                        foreach($userdata as $ou)
                            {
                                $likeduser[$i] = \DB::table('likes')->join('userdetails',"userdetails.user_id","=","likes.from_user_id")
                                ->where([
                                    'likes.to_user_id' => $user->id,
                                    'likes.like_type' => 'like'
                                ])->take($slots->liked_profile_to_display)
                                ->get();
                                    
                                $dislikeuser[$i] = \DB::table('likes')->join('userdetails',"userdetails.user_id","=","likes.from_user_id")
                                    ->where([
                                        'likes.to_user_id' => $user->id,
                                        'likes.like_type' => 'dislike'
                                    ])->take($slots->dislike_profile_to_display)
                                    ->get();  
                                    
                                if(isset($likeduser[$i]) == true && isset($dislike[$i]) == true)
                                    {
                                        $i++;
                                    }
                                break; # this is used to break the loop because we don't want the duplicate values
                                    
                            }
                            $success = [
                                'message'=>"first slot data after creating the user slot",
                                'likeduser' => $likeduser,
                                'dislikeuser' => $dislikeuser
                            ];
                            return response()->json(["success"=>$success],200);
                    }
                    // here checking the slot profiles is all viewed or not
                    $user_active_slot = UserSlots::where([
                        'user_id' => $user->id,
                        'is_slot_shown' => '1'
                    ])->first();

                    if($user_active_slot == null)
                    {
                        $success = [
                            'message' => "slot countinue profile",
                            'likeduser' => $likeduser,
                            'dislikeuser' => $dislikeuser
                        ];
                        return response()->json(["success"=>$success],200);   
                    }

                    $gettingcurrentseq = slotting_done_on_profile::select('slot_sequence')->where('id',$user_active_slot->slot_id)->first();
                    //dd($gettingcurrentseq->slot_sequence);
                    $nextslotseq = $gettingcurrentseq->slot_sequence + 1;
                    //dd($nextslotseq);
                    $slots = slotting_done_on_profile::where('slot_sequence', $nextslotseq)->first();
                    //dd($slots);
                    if($slots != null)
                    {
                        $getuserslot = UserSlots::where('user_id',$user->id)->first();
                        //dd($getuserslot);
                        $getuserslot->update([
                            'slot_id' => $slots->id,
                            'profile_seen_by_user' => 0,
                            'is_slot_shown' => 0,
                        ]);
                        
                        $likeduser = array();
                        $dislikeuser = array();
                        $i=0;
                        //dd(count($userdata));
                        foreach($userdata as $ou)
                            {
                                $likeduser[$i] = \DB::table('likes')->join('userdetails',"userdetails.user_id","=","likes.from_user_id")
                                ->where([
                                    'likes.to_user_id' => $user->id,
                                    'likes.like_type' => 'like'
                                ])->take($slots->liked_profile_to_display)
                                ->get();
                                    
                                $dislikeuser[$i] = \DB::table('likes')->join('userdetails',"userdetails.user_id","=","likes.from_user_id")
                                    ->where([
                                        'likes.to_user_id' => $user->id,
                                        'likes.like_type' => 'dislike'
                                    ])->take($slots->dislike_profile_to_display)
                                    ->get();  
                                    
                                if(isset($likeduser[$i]) == true && isset($dislike[$i]) == true)
                                    {
                                        $i++;
                                    }
                                break; # this is used to break the loop because we don't want the duplicate values
                                    
                            }
                            $success = [
                                'message' => "slot interchange data for n slots",
                                'likeduser' => $likeduser,
                                'dislikeuser' => $dislikeuser
                            ];
                            return response()->json(["success"=>$success],200);
                    }
                    return response()->json(["success"=>"You have seen all the profile's till now"],200);
                }
                //dd("displaying this data");
                $userdata = Userdetail::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$lat, $lng, $lat])
                ->where('gender',$gender->looking_for)
                ->take($profile->profile_to_displayed)
                ->get();
                $success = [
                    'message' => "displaying profile on the bases of gender, distance and on profile to be displayed",
                    'userdata' => $userdata
                ];
                return response()->json(["success"=>$success],200);
            }
            $userdata = Userdetail::where('gender','!=',$user->userdetail->gender)->get();
            return response()->json(["success"=>$userdata],200);
        }
        return response()->json(["success"=>"Unauthorize Access"]);
    }

    public function illiwillnot(Request $request)
    {
        $user = Auth::user();
        //dd(count($request->i_will));
        if($user)
        {
            for ($i = 0; $i < count($request->i_will); $i++) {
                $iwilliwillnot[] = [
                    'user_id' => $user->id,
                    'i_will' => "I will"." ".$request->i_will[$i],
                    'i_will_not' => "I will not"." ".$request->i_will_not[$i]
                ];
            }
            iwilliwillnot::insert($iwilliwillnot);
            return response()->json(["success"=>"Data is stored successfully"],200);
        }
        return response()->json(["success","Unauthorize User"],401);
    }
}
