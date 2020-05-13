<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  App\Models\DonationReq;
class DonationController extends Controller
{
    public  function addDonation(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'patient_name' => 'required|max:60',
            'bags_num' => 'required|numeric',
            'blood_type_id' => 'required|numeric',
            'hospital_name' => 'required',
            'age' => 'required',
            'city_id' => 'required|numeric',
            'longitude' => 'required',
            'latitude' => 'required',
            'patient_phone' => 'required|alpha_num',
        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }

        $donation = DonationReq::create($request->all());
         if($donation){
        return get_response("1", "تمت الاضافة بنجاح",$donation);
         }else{
            return get_response("1", "  حاول مرة اخري",$donation);
         }
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public  function getAllDonations(Request $request)
    {

        $donation = DonationReq::where(function($q) use($request){
         if($request->govern_id){
             $q->whereHas("city",function($q) use ($request){
                 $q->where("govern_id",$request->govern_id);
             });
         }elseif($request->city_id){
            $q->where("city_id",$request->city_id);
         }
         if($request->blood_type_id){
            $q->where("blood_type_id",$request->blood_type_id);
         }

        })->with("blood_type")->with("blood_type")->with("city.govern")->get();


        return get_response("1", "loaded.....  ",$donation);
    }


    /////////////////////////////////////////////////////////////////////////////////////////

    public  function getDonation(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'id' => 'required|numeric|exists:App\Models\DonationReq,id',
        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }


        $donation = DonationReq::where("id",$request->id)->with("blood_type")->with("blood_type")
        ->with("city.govern")->first();


        return get_response("1", "loaded.....  ",$donation);
    }

    /////////////////////////////////////////////////////////////////////////////////////////
}
