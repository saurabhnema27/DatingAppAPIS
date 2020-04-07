<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\admintoken;
use App\Http\Controllers\Redirect;
use App\User;
use App\Userdetail;
use App\user_superlike;
use Session;
use App\profile_display;
use App\Configuration;
use App\slotting_done_on_profile;
use App\SuperLike;
use App\Boost;
use App\like;
use App\user_boost;
use App\Userimage;
use App\stringsGo;
use App\user_string_go;
use App\HiddenProfile;
use App\user_hidden_profile;

class AdminController extends Controller
{
    //
    public function adminLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $checkemail = admin::where('email',$email)->first();
        //dd($checkemail);
        if($checkemail)
        {   
            if(\Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')]))
            {
                $session = $request->session();
                $session->put("data",$request->email);
                $u = User::all();
                $superlike = user_superlike::all();
                $boosts = user_boost::all();
                $hiddenProfile = user_hidden_profile::all();
                $stringsGo = user_string_go::all();
                $totalswipe = Like::all();
                $maleusers = Userdetail::where("gender","male")->get();
                $femaleusers = Userdetail::where("gender","female")->get();
                $data = [
                    'users' => $u,
                    'superlike' => $superlike,
                    'boosts' => $boosts,
                    'hiddenprofile' => $hiddenProfile,
                    'stringsgo' => $stringsGo,
                    'totalswipe' => $totalswipe,
                    'male' => $maleusers,
                    'female' => $femaleusers,
                ];
                return view('admin.dashboard')->with('data',$data);
            }

        }
        $error = [
            'message'=> "Invalid Email please try again later"
        ];
        return redirect('adminlogin')->with('error', 'Invalid email or password');
    }

    public function changepassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'newpassword' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirmpassword' => 'required|required_with:password|same:newpassword',
        ],
        [
            'newpassword.regex' => "Your Password should have atleast one special charater, one aplhanumaric, and one caps character",
            'confirmpassword.required_with'=> "Confirm password field is required",
            'confirmpassword.same'=> "Your Confirm password must be same as Password"
        ]);
        
        if ($validator->fails()) { 
            return redirect("/changepassword")->with("error",$validator->errors());            
        }

        $admin = session()->get('data');
        // dd($admin);
        $gettingadmin = admin::where('email',$admin)->first();
        if($gettingadmin)
        {
            $newpassword = $request->newpassword;
            $oldpass = $request->oldpassword;
            //dd($oldpass,$newpassword);
            if(\Hash::check($oldpass, $gettingadmin->password))
            {
                $bypass = bcrypt($newpassword);
                $gettingadmin->update([
                    'password'=> $bypass
                ]);
                $request->session()->forget('data');
                $request->session()->flush();
                return redirect('/adminlogin')->with("success","Password change successfully, please login again");
            }
            return redirect("/changepassword")->with("error","Your Old Password Didn't match");
        }
        return redirect("/changepassword")->with("error","Opps admin not found");
       
    }

    public function dashboard()
    {
        // 
    }

    public function logout(Request $request)
    {
        $request->session()->forget('data');
        $request->session()->flush();
        return redirect('/adminlogin');
    }

    public function addProfileToBeShown(Request $request)
    {
        //dd("comming here");
        $profile = $request->profile;
        $slots = $request->slots;
        //dd($profile);   
        $check = profile_display::all();
        if((isset($check['0']))===true)
        {
            return redirect('/showprofile')->with("error","You can't add new Profilr edit old one please");
        }
        $pd = new profile_display;
        if($profile)
        {
            $check = profile_display::all();
            //dd($check);
            if(isset($check) == false)
            {
                $pd->where('id','1')->update([
                    'profile_to_displayed' => $profile,
                    'slots_needed' => $slots ? : null
                ]);
                return redirect('/addprofile')->with('success',"profile created successfully");
            }
            $pd->profile_to_displayed = $profile;

            if($slots)
            {
                $pd->slots_needed = $slots;
            }

            $pd->save();
            return redirect('/addprofile')->with('success',"profile created successfully");
        }
        return redirect('/addprofile')->with("error","Opps Something went wrong");
    }

    // configuration CURD 
    public function showallconfiguration()
    {
        $conf = Configuration::all();
        return view('admin.showconfiguration')->with("conf",$conf);
    }

    public function editconfiguration($id)
    {
        $conf = Configuration::find($id);
        return view('admin.editconfiguration')->with("conf",$conf);
    }

    public function updateconfiguration(Request $request,$id)
    {
        $conf = Configuration::find($id);
        $conf->SUPERLIKE_ALLOWED = $request->superlike;
        $conf->save();
        return redirect('/showconfiguration')->with("success","configuration is updated successfully");
    }

    public function addOTPEmailExpiration(Request $request)
    {
        $superlike = $request->superlike;

        $check = Configuration::find(1);
        if($check)
        {
            return redirect('/showconfiguration')->with("error","You can't add new configuration edit old one please");
        }
        $cnf = new Configuration;
        if($superlike)
        {
            $cnf->OTP_EXPIRE_TIME_IN_MIN = 15;
            $cnf->EMAIL_TOKEN_EXPIRE_TIME_IN_MIN =  15;
            $cnf->SUPERLIKE_ALLOWED = $superlike;
            $cnf->save();
            return redirect('/showconfiguration')->with('success',"configuration created successfully");
        }
        return redirect('/addconfiguration')->with("error","Opps Something went wrong");
    }

    public function addSlottingOnProfile(Request $request)
    {
        $validation = slotting_done_on_profile::where('slot_sequence',$request->slotsequence)->first();
        if($validation)
        {
            return redirect('/showallslots')->with("error","This slot sequence is already used"); 
        }
        $slotnumber = $request->slotnumber;
        $like = $request->likeprofiletodisplay;
        $dislike = $request->dislikeprofiletodisplay;
        $notseen = $request->notseenprofiletodisplay;
        $slotseq = $request->slotsequence;
        $slottiming = $request->slottime;

        //dd($slotnumber);

        #detting the profile info first to check where profile is allocated for a day or not
        $profile = profile_display::all();
        
        if(isset($profile['0']) === false)
        {
            return redirect('/showallslots')->with("error","Can't add slotting because proifle is not added till now please add it"); 
        }
        
        elseif($profile[0]['slots_needed'] == null || $profile[0]['slots_needed'] == 0 )
        {
            return redirect('/showallslots')->with("error","Can't add slotting because proifle didn't have an slot count please modify it"); 
        }
        elseif($slotnumber > $profile[0]['profile_to_displayed'])
        {
            return redirect('/showallslots')->with("error","Can't add slotting because your first slot size is incresed by the total profile shown in day"); 
        }
        elseif($profile[0]['slots_needed'] > slotting_done_on_profile::all()->count() == false)
        {
            return redirect("/showallslots")->with("error","You can't add more slots because in profile the slot count is less then"." ".$profile[0]['slots_needed']);
        }
        elseif(slotting_done_on_profile::all()->count() >= 1)
        {
            $slotscount = slotting_done_on_profile::all();
            $i=0;
            $sn = array();
            foreach($slotscount as $sc)
            {
                $sn[$i] = $sc->slot_number;
                $i++;
            }
            if(array_sum($sn) + $slotnumber  > $profile[0]['profile_to_displayed'])
            {
                return redirect("/showallslots")->with("error","total count of slots is greater then profile to display in a day");
            }
        }

        $slotscheck = slotting_done_on_profile::all();
         
        // if slot count is more then 2
        //dd($profile[0]['slots_needed'] < slotting_done_on_profile::all()->count());
        

        if($like + $dislike + $notseen == $slotnumber)
        {
            $sdop = new slotting_done_on_profile;
            $sdop->slot_number = $slotnumber ;
            $sdop->liked_profile_to_display = $like;
            $sdop->dislike_profile_to_display = $dislike;
            $sdop->notseen_profile_to_display = $notseen;
            $sdop->slot_sequence = $slotseq;
            $sdop->slot_timing = $slottiming ? : null;
            $sdop->save();
            return redirect('/showallslots')->with("success","slot is added successfully");
        }
        return redirect('/addslotting')->with("error","Displaying details is less then or greater then a slot displaying profile");
        
    }


    public function showprofile()
    {
        $profile = profile_display::all();
        return view('admin.showallprofile')->with("profile",$profile);
    }

    public function editprofile($id)
    {
        $profile = profile_display::find($id);
        if($profile)
        {
            return view('admin.editprofile')->with("profile",$profile);
        }
        return redirect('/showprofile')->with("error","Profile not Found");
    }

    public function updateprofile(Request $request, $id)
    {
        $profile = profile_display::find($id);
        if($profile)
        {
            $profile->profile_to_displayed = $request->profile;
            $profile->slots_needed = $request->slots;
            $profile->save();
            return redirect('/showprofile')->with("delete","profile is updated successfully");
        }
    }

    public function deleteprofile(Request $request,$id)
    {
        $profile = profile_display::find($id);
        if($profile)
        {
            $profile->delete();
            return redirect("/showprofile")->with("success","profile is delete successfully");
        }
    }


    // slots CURD
    public function allslots()
    {
        $slots = slotting_done_on_profile::all();
        return view('admin.showallslots')->with("slots",$slots);
    }

    public function editslots($id)
    {
        $check = slotting_done_on_profile::find($id);
        return view('admin.editslot')->with("check",$check);
    }

    public function updateslot(Request $request, $id)
    {
        $slotnumber = $request->slotnumber;
        $like = $request->likeprofiletodisplay;
        $dislike = $request->dislikeprofiletodisplay;
        $notseen = $request->notseenprofiletodisplay;
        $slotseq = $request->slotsequence;
        $slottiming = $request->slottime;

        //dd($slotnumber);

        #detting the profile info first to check where profile is allocated for a day or not
        $profile = profile_display::all();
        
        if(isset($profile['0']) == false)
        {
            return redirect('/addslotting')->with("error","Can't add slotting because proifle is not added till now please add it"); 
        }
        
        if($profile[0]['slots_needed'] == null)
        {
            return redirect('/addslotting')->with("error","Can't add slotting because proifle didn't have an slot count please modify it"); 
        }
        if($slotnumber > $profile[0]['profile_to_displayed'])
        {
            return redirect('/addslotting')->with("error","Can't add slotting because your first slot size is incresed by the total profile shown in day"); 
        }
         

        if($like + $dislike + $notseen == $slotnumber)
        {
            $sdop = slotting_done_on_profile::find($id);
            $sdop->slot_number = $slotnumber;
            $sdop->liked_profile_to_display = $like;
            $sdop->dislike_profile_to_display = $dislike;
            $sdop->notseen_profile_to_display = $notseen;
            $sdop->slot_sequence = $slotseq;
            $sdop->slot_timing = $slottiming ? : null;
            $sdop->save();
            return redirect('/showallslots')->with("update","slot is update successfully");
        }
        return redirect('/addslotting')->with("error","Displaying details is less then or greater then a slot displaying profile");
        
    }

    public function deleteslots($id)
    {
        $getid = slotting_done_on_profile::find($id);
        $getid->delete();
        return redirect('/showallslots')->with("delete","slot is delete successfully");
    }


    
    // superlike CURD operations

    public function showsuperlikelist()
    {
        $superlike = SuperLike::all();
        return view('admin.showallsuperlikelist')->with("superlike",$superlike);
    }

    public function addsuperlikepckg(Request $request)
    {
        $sl = new SuperLike;
        $sl->price = $request->price;
        $sl->count = $request->count;
        $sl->package_is_for = $request->package_is_for;
        $sl->pacakge_count = $request->pacakge_count;
        $sl->save();
        return redirect('/superlikepckglist')->with("success","Superlike package is created successfully");
    }

    public function editsuperlikepckg($id)
    {
        $find = SuperLike::find($id);
        if($find)
        {
            return view('admin.editsuperlikepckg')->with("find",$find);
        }
        return redirect('/superlikepckglist')->with("error","package not found");
    }

    public function updatesuperlikepckg(Request $request,$id)
    {
        $check = SuperLike::find($id);
        if($check)
        {
            $check->price = $request->price;
            $check->count = $request->count;
            $check->package_is_for = $request->package_is_for;
            $check->pacakge_count = $request->pacakge_count;
            $check->save();
            return redirect("/superlikepckglist")->with("success","Package is updated successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    public function deletesuperlikepckg($id)
    {
        $findid = SuperLike::find($id);
        if($findid)
        {
            $findid->delete();
            return redirect("/superlikepckglist")->with("success","Package is delete successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    // Boosts profile CURD Operations

    public function showboostslist()
    {
        $boosts = Boost::all();
        return view('admin.showallboostspackg')->with("boosts",$boosts);
    }

    public function addboostsepckg(Request $request)
    {
        $sl = new Boost;
        $sl->price = $request->price;
        $sl->boost_count = $request->count;
        $sl->package_is_for = $request->package_is_for;
        $sl->pacakge_count = $request->pacakge_count;
        $sl->save();
        return redirect('/showallboosts')->with("success","Boosts package is created successfully");
    }

    public function editboostspckg($id)
    {
        $find = Boost::find($id);
        if($find)
        {
            return view('admin.editboostspckg')->with("find",$find);
        }
        return redirect('/showallboosts')->with("error","package not found");
    }

    public function updateboostspckg(Request $request,$id)
    {
        $check = Boost::find($id);
        if($check)
        {
            $check->price = $request->price;
            $check->boost_count = $request->count;
            $check->package_is_for = $request->package_is_for;
            $check->pacakge_count = $request->pacakge_count;
            $check->save();
            return redirect("/showallboosts")->with("success","Package is updated successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    public function deleteboostspckg($id)
    {
        $findid = Boost::find($id);
        if($findid)
        {
            $findid->delete();
            return redirect("/showallboosts")->with("success","Package is delete successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    // DashBoard 

    public function userslist()
    {
        $users = User::paginate(15);
        return view('admin.showallusers')->with("users",$users);
    }

    public function viewuser($id)
    {
        $gettinguser = User::find($id);
        $rightswipe = 0;
        $leftswipe =0;
        $superlike =0;
        //dd($gettinguser->id);
        if($gettinguser)
        {
            $userdetails = Userdetail::where('user_id',$gettinguser->id)->first();
            if($userdetails != null)
            {
                $like = Like::where('from_user_id',$gettinguser->id)->get();
                foreach($like as $l)
                {
                    if($l->like_type == 'Like')
                    {
                       $rightswipe= $rightswipe +1;
                    }
                    if($l->like_type == 'SuperLike')
                    {
                        $superlike = $superlike +1;
                    }
                    if($l->like_type == 'Dislike')
                    {
                        $leftswipe = $leftswipe+1;
                    }
                }
                // User Pattern for Swipping
                $right = \str_repeat("R",$rightswipe);
                $left = \str_repeat("L",$leftswipe);
                $super = \str_repeat("U",$superlike);
                $pattern = $right.$left.$super;

                // packages he buyed
                $superlike_pck = user_superlike::where('user_id',$gettinguser->id)->get();
                $boosts_pck = user_boost::where('user_id',$gettinguser->id)->get();
                $hiddenprofile_pck = user_hidden_profile::where('user_id',$gettinguser->id)->get();
                $stringsgo_pck = user_string_go::where('user_id',$gettinguser->id)->get();
                
                // UserImages

                $user_images = Userimage::select('image_name','id')->where('user_id',$gettinguser->id)->get();

                // usermatches
                $getloginuserlikelist = Like::where('from_user_id',$gettinguser->id)->get();
                $i=0;
                $matches = array();
                foreach($getloginuserlikelist as $lull)
                {
                    // getting the details of the users which he liked or superlike
                    $getonebyonelike[$i] = Userdetail::where('user_id',$lull->to_user_id)->first();

                    // testing a check where the other user liked him or not, to whome he liked
                    $testcase[$i] = Like::where([
                        ['from_user_id',$getonebyonelike[$i]->user_id],
                        ['to_user_id',$gettinguser->id],
                        ['like_type','Like'],
                    ])->orWhere([
                        ['from_user_id',$getonebyonelike[$i]->user_id],
                        ['to_user_id',$gettinguser->id],
                        ['like_type','Superlike'],
                    ])->first();

                    // checking where there is anyone or not who liked him or not 
                    if(!empty($testcase))
                    {
                        $matches[$i] = $testcase[$i];  
                    }
                    $i++;
                }
            
                
                $data = array(
                    'userdetails' => $userdetails,
                    'like' => $like,
                    'rightswipe' => $rightswipe,
                    'leftswipe' => $leftswipe,
                    'superlike' => $superlike,
                    'pattern' => $pattern,
                    'userimages' => $user_images,
                    'superlike_pck' => $superlike_pck,
                    'boosts_pck' => $boosts_pck,
                    'hiddenprofile_pck' => $hiddenprofile_pck,
                    'stringsgo_pck' => $stringsgo_pck,
                    'total_pck' => count($superlike_pck) + count($boosts_pck) + count($hiddenprofile_pck) + count($stringsgo_pck),
                    'matches' => $matches,
                );
                return view('admin.clickuserlist')->with("data",$data);
            }
            return redirect('/alluserslist')->with("error", "Details Not Found for this user");
            
        }
    }

    public function deactivateuser($id)
    {
        $finduser = User::find($id);
        if($finduser)
        {
            //dd($finduser);
            $finduser->update(['is_user_active'=>'0']);
            return redirect("/alluserslist")->with("success","user is deactivated successfully");
        }
        return redirect("/alluserslist")-with("error","User Not found");
    }

    public function activateuser($id)
    {
        $finduser = User::find($id);
        if($finduser)
        {
            //dd($finduser);
            $finduser->update(['is_user_active'=>'1']);
            return redirect("/alluserslist")->with("success","user is activated successfully");
        }
        return redirect("/alluserslist")-with("error","User Not found");
    }

    // Hidden profile CURD Operations

    public function showallhiddenprofile()
    {
        $hp = HiddenProfile::all();
        return view('admin.showallhiddenprofile')->with("hp",$hp);
    }

    public function addhiddenprofilepck(Request $request)
    {
        $sl = new HiddenProfile;
        $sl->price = $request->price;
        $sl->count = $request->count;
        $sl->package_is_for = $request->package_is_for;
        $sl->pacakge_count = $request->pacakge_count;
        $sl->save();
        return redirect('/showallhiddenprofile')->with("success","Hidden Profile package is created successfully");
    }

    public function edithiddenprofilepck($id)
    {
        $find = HiddenProfile::find($id);
        if($find)
        {
            return view('admin.edithiddenprofilepckg')->with("find",$find);
        }
        return redirect('/showallhiddenprofile')->with("error","package not found");
    }

    public function updatehiddenprofilepckg(Request $request,$id)
    {
        $check = HiddenProfile::find($id);
        if($check)
        {
            $check->price = $request->price;
            $check->count = $request->count;
            $check->package_is_for = $request->package_is_for;
            $check->pacakge_count = $request->pacakge_count;
            $check->save();
            return redirect("/showallhiddenprofile")->with("success","Package is updated successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    public function deletehiddenprofilespckg($id)
    {
        $findid = HiddenProfile::find($id);
        if($findid)
        {
            $findid->delete();
            return redirect("/showallhiddenprofile")->with("success","Package is delete successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    // StringGo Package Curd
    public function showallstringsgopck()
    {
        $sg = stringsGo::all();
        return view('admin.showallstringsgopck')->with("sg",$sg);
    }

    public function addstringgopck(Request $request)
    {
        $sl = new stringsGo;
        $sl->superlike = "Superlike";
        $sl->superlike_count = $request->superlike_count;
        $sl->boosts = "Boosts";
        $sl->boosts_count = $request->boosts_count;
        $sl->change_location = "Change_Location";
        $sl->change_location_count = $request->change_location_count;
        $sl->rewind_swipe = "Rewind_Swipe";
        $sl->rewind_count = $request->rewind_count;
        $sl->package_is_for = $request->package_is_for;
        $sl->pacakge_count = $request->pacakge_count;
        $sl->save();
        return redirect('/showallstringsgopck')->with("success","Hidden Profile package is created successfully");
    }

    public function editstringgopckg($id)
    {
        $find = stringsGo::find($id);
        if($find)
        {
            return view('admin.editstringgopckg')->with("find",$find);
        }
        return redirect('/showallstringsgopck')->with("error","package not found");
    }

    public function updatestringgopckg(Request $request,$id)
    {
        $check = stringsGo::find($id);
        if($check)
        {
            $check->superlike = "Superlike";
            $check->superlike_count = $request->superlike_count;
            $check->boosts = "Boosts";
            $check->boosts_count = $request->boosts_count;
            $check->change_location = "Change_Location";
            $check->change_location_count = $request->change_location_count;
            $check->rewind_swipe = "Rewind_Swipe";
            $check->rewind_count = $request->rewind_count;
            $check->package_is_for = $request->package_is_for;
            $check->pacakge_count = $request->pacakge_count;
            $check->save();
            return redirect("/showallstringsgopck")->with("success","Package is updated successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }

    public function deletestringsgopckg($id)
    {
        $findid = stringsGo::find($id);
        if($findid)
        {
            $findid->delete();
            return redirect("/showallstringsgopck")->with("success","Package is delete successfully");
        }
        return redirect()->back()->withErrors("error","Opps package not found");
    }



}
