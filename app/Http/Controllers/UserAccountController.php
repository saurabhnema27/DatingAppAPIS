<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Report;
use App\ReportUser;
use App\Userdetail;
use App\BlockUser;
use App\Otp;
use App\emailtoken;
use Illuminate\Support\Facades\Log;
use App\Boost;
use App\UserPayment;
use App\HiddenProfile;
use App\user_hidden_profile;
use App\SuperLike;
use App\configuration;
use App\user_superlike;
use App\user_boost;
use App\stringsGo;

class UserAccountController extends Controller
{
    public function blockUser($id)
    {
        // logic here
        $user = Auth::user();
        if($user)
        {
            $bu = new BlockUser;
            $bu->to_block_id = $id;
            $bu->from_block_id = $user->id;
            $bu->reason = $request->reason || "Not getting that vibes";
            $bu->save();
            if($bu)
            {
                return response()->json(["success"=>"Blocked Done "],200);
            }
            else
            {
                return response()->json(["success"=>"Opps something went wrong"],404);
            }
        }
        else
        {
            return response()->json(["success"=>"Unauthorize Access"],401);
        }
    }

    public function deleteMyAccount()
    {
        // delete my account
        $user = Auth::user();
        if($user)
        {
            $user->Like()->delete();
            $user->Userdetail()->delete();
            $user->Otp()->delete();
            //$user->reportUser()->delete();
            $user->emailtoken()->delete();
            $user->userintrest()->delete();
            $user->BlockUser()->delete();
            $user->Userimage()->delete();
            $user->delete();
            return response()->json(["success"=>"Your account is deleted permanently"],200);
        }
        return response()->json(["success"=>"Unauthorize Access"],401);
        
    }


    public function reportUser(Request $request,$id)
    {
        // 
        // need to write a logic for user can't report to himself
        // 
        $user = Auth::user();
        //dd($user->Userdetail);
        if($user)
        {
            $getid = User::find($id);
            if(!$getid)
            {
                return response()->json(["success"=>"Opps User not found"],404);
            }
            $from_user_id = $user->id;

            $to_request_id = $id;
            $report_id = $request->report_id;

            $gettingreportid = Report::where('id',$report_id)->first();
            if($gettingreportid)
            {
                $reportuser = new ReportUser;
                $reportuser->report_id = $report_id;
                $reportuser->to_user_id = $to_request_id;
                $reportuser->from_user_id = $from_user_id;
                $reportuser->save();
                if($reportuser)
                {
                    return response()->json(["success"=>"Report Genrate successfully for the user"],200);
                }
                return response()->json(["success"=>"Opps something went wrong"],404);
            }
            
            else
            {
                $report = new Report;
                $report->report_title = "User generated Report";
                $report->report_content = $request->report_content ;
                //dd($report_title);
                $report->save();

                $reportuser = new ReportUser;
                $reportuser->report_id = $report->id;
                $reportuser->to_user_id = $to_request_id;
                $reportuser->from_user_id = $from_user_id;
                $reportuser->save();
                if($reportuser)
                {
                    return response()->json(["success"=>"Report Genrate successfully for the user"],200);
                }
                return response()->json(["success"=>"Opps something went wrong"],404);
            }
        }
        return response()->json(["success"=>"Unauthorize Access"],401);
        
    }

    public function deactivateAccount()
    {
        $user = Auth::user();
        //dd($user->id);
        if($user)
        {
            $deactivate = $user->update(['is_user_active'=>'0']);
            if($deactivate)
            {
                return response()->json(["success"=>"User is deactivated successfully"],200);
            }
            return response()->json(["success"=>"Something went wrong"],404);

        }
        else
        {
            return response()->json(["success"=>"Unauthorize Access"],401);
        }
        
    }

    // All Packages List
    public function boostList()
    {
        $user = Auth::user();
        if($user)
        {
            $boost = Boost::all();
            return response()->json(["success"=>$boost],200);
        }
    }

    public function superlikeList()
    { 
        $user = Auth::user();
        if($user)
        {
            $sl = SuperLike::all();
            return response()->json(["success"=>$sl],200);
        }
    }

    public function HiddenProfileList()
    {
        $user = Auth::user();
        if($user)
        {
            $hp = HiddenProfile::all();
            return response()->json(["success"=>$hp],200);
        }
    }

    public function stringsgolist()
    {
        $user = Auth::user();
        if($user)
        {
            $sg = stringsGo::all();
            return response()->json(["success"=>$sg],200);
        }
    }

    public function buyBoosts(Request $request, $id)
    {
        $user = Auth::user();
        {
            $gettingBoosts = Boost::where('id',$id)->first();
            //dd($gettingBoosts->price);
            if($gettingBoosts)
            {
                // Payment gateway

                // after getting response
                $pay = new UserPayment;
                $pay->user_id = $user->id;
                $pay->payment_mode = "online";
                $pay->amount = $gettingBoosts->price;
                $pay->status = "successfull";
                $pay->package_id = $id;
                $pay->user_id = $user->id;
                $pay->purchase_type = "Boosts";
                $pay->save();
                if($pay)
                {
                    $crtsuplke = new user_boost;
                    $crtsuplke->user_id = $user->id;
                    $crtsuplke->count_boosts = $gettingBoosts->boost_count;     
                    $crtsuplke->valid_till = $gettingBoosts->pacakge_count;
                    $crtsuplke->pck_id = $gettingBoosts->id;
                    $crtsuplke->is_expired = 0;
                    $crtsuplke->save();
                    return response()->json(["success"=>"Boosts Purchase successfully"],200);
                }
            }
            return response()->json(["success"=>"Opps Boosts Not Found"],200);
        }
    }

    public function buySuperlike(Request $request,$id)
    {
        $user = Auth::user();
        {
            $gettingSuperLike = SuperLike::where('id',$id)->first();
            //dd($gettingSuperLike->price);
            if($gettingSuperLike)
            {
                // Payment gateway

                // after getting response
                $pay = new UserPayment;
                $pay->user_id = $user->id;
                $pay->payment_mode = "online";
                $pay->amount = $gettingSuperLike->price;
                $pay->status = "successfull";
                $pay->package_id = $id;
                $pay->purchase_type = "superlike";
                $pay->user_id = $user->id;
                $pay->save();
                if($pay)
                {
                    $crtsuplke = new user_superlike;
                    $crtsuplke->user_id = $user->id;
                    $crtsuplke->count_superlike = $gettingSuperLike->count;     
                    $crtsuplke->valid_till = $gettingSuperLike->pacakge_count;
                    $crtsuplke->pck_id = $gettingSuperLike->id;
                    $crtsuplke->save();
                    return response()->json(["success"=>"Boosts Purchase successfully"],200);
                }
            }
            return response()->json(["success"=>"Opps Boosts Not Found"],200);
        }
    }

    public function buyStringsGo(Request $request,$id)
    {
        $user = Auth::user();
        {
            $stringgo = stringsGo::where('id',$id)->first();
            //dd($stringgo);
            if($stringgo)
            {
                // Payment gateway

                // after getting response
                $pay = new UserPayment;
                $pay->user_id = $user->id;
                $pay->payment_mode = "online";
                $pay->amount = $stringgo->price;
                $pay->status = "successfull";
                $pay->package_id = $id;
                $pay->purchase_type = "StringsGo";
                $pay->user_id = $user->id;
                $pay->save();
                if($pay)
                {
                    $crtstringsgo = new user_string_go;
                    $crtstringsgo->user_id = $user->id;
                    $crtstringsgo->count_superlike = $stringgo->count;   
                    $crtstringsgo->count_boosts = "";
                    $crtstringsgo->change_location_count = "";
                    $crtstringsgo->rewind_count = ""; 
                    $crtstringsgo->valid_till = $stringgo->pacakge_count;
                    $crtstringsgo->pck_id = $stringgo->id;
                    $crtstringsgo->save();
                    return response()->json(["success"=>"Boosts Purchase successfully"],200);
                }
            }
            return response()->json(["success"=>"Opps Boosts Not Found"],200);
        }
    } 

    // Payment history of login users
    public function userPaymentHistory()
    {
        $user = Auth::user();
        if($user)
        {
            $userpayments = UserPayment::select('*')->join('boosts',"boosts.id","=","user_payments.boosts_id")
            ->where('user_id',$user->id)
            ->get();
            return response()->json(["success"=>$userpayments],200);
        }
        return response()->json(["success"=>"Unauthorize Access"],200);
    }


    public function buyhiddenprofile(Request $request,$id)
    {
        $user = Auth::user();
        {
            $gettinghiddenprofile = HiddenProfile::where('id',$id)->first();
            //dd($gettingSuperLike->price);
            if($gettinghiddenprofile)
            {
                // Payment gateway

                // after getting response
                $pay = new UserPayment;
                $pay->user_id = $user->id;
                $pay->payment_mode = "online";
                $pay->amount = $gettingSuperLike->price;
                $pay->status = "successfull";
                $pay->package_id = $id;
                $pay->purchase_type = "superlike";
                $pay->user_id = $user->id;
                $pay->save();
                if($pay)
                {
                    $crthdnprle = new user_hidden_profile;
                    $crthdnprle->user_id = $user->id;
                    $crthdnprle->count_superlike = $gettinghiddenprofile->count;     
                    $crthdnprle->valid_till = $gettinghiddenprofile->pacakge_count;
                    $crthdnprle->pck_id = $gettinghiddenprofile->id;
                    $crthdnprle->save();
                    return response()->json(["success"=>"Hidden Profile Purchase successfully"],200);
                }
            }
            return response()->json(["success"=>"Opps Hidden Profile Package Not Found"],200);
        }
    }

    public function cancelSuperlikeSubs(Request $request, $id)
    {
        $user = Auth::user();
        if($user)
        {
            $findsubs = user_superlike::find($id);
            if($findsubs)
            {
                $findsubs->update("is_expired","1");
                return response()->json(["success","subscription is cancel successfully"],200);
            }
            return response()->json(["success"=>"No subscription found"],404);
        }
    }

    public function cancelBoostsSubs(Request $request, $id)
    {
        $user = Auth::user();
        if($user)
        {
            $findsubs = user_boost::find($id);
            if($findsubs)
            {
                $findsubs->update("is_expired","1");
                return response()->json(["success","subscription is cancel successfully"],200);
            }
            return response()->json(["success"=>"No subscription found"],404);
        }
    }

    public function activeSubsList()
    {
        $user = Auth::user();
        if($user)
        {
            $superlike = user_superlike::where('user_id',$user->id)->get();
            return response()->json([
                "message" => "user active subscription list",
                "superlikeSubs" => $superlike
            ],200);
        }
        return response()->json(["success"=>"Unauthorize Access"],401);    
    }

    public function unblockUser($id)
    {
        $user = Auth::user();
        if($user)
        {
            $gettinguser = BlockUser::where([
                'from_block_id' => $id,
                'to_block_id' => $user->id,
            ])->first();

            if($gettinguser)
            {
                $gettinguser->delete();
                return response()->json(["success"=>"Unblock is done for user"],200);
            }
            return response()->json(["success"=>"Opps user not found"],404);
        }
        return response()->json(["success"=>"Unauthorize User"],401);
    }
}

