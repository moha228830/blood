<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  App\Models\DonationReq;
use  App\Models\Token;
class DonationController extends Controller
{
    public  function addDonation(Request $request)
    {

        $messeges = [
            'patient_name.required'=>" ادخل الاسم ",
            'patient_name.max'=>"عدد احرف الاسم اكبر من 60 حرف",
            'patient_name.min'=>"عدد احرف الاسم اقل من 4 احرف",
            'blood_type_id.required'=>"  اختر فصيلة الدم",
            'hospital_name.required'=>" ادخل اسم المستشفي ",
            'age.required'=>"  ادخل عمر المريض",
            'city_id.required'=>"  اختر المدينة",
            'patient_phone.required'=>" ادخل رقم تليفون المريض ",
            'bags_num.required'=>" ادخل عدد اكياس الدم ",
            'bags_num.numeric'=>"  عدد الاكياس يجب ان تكون ارقام",
            'hospital_address.required'=>"  ادخل عنوان المستشفي",


           ];



        $validator =  Validator::make($request->all(), [
            'patient_name' => 'required|max:60|min:4',
            'bags_num' => 'required|numeric',
            'blood_type_id' => 'required|numeric',
            'hospital_name' => 'required',
            'age' => 'required',
            'city_id' => 'required|numeric',
            'longitude' => 'required',
            'latitude' => 'required',
            'patient_phone' => 'required',
            "hospital_address"=>'required',
        ],$messeges);



        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }



        $donation =$request->user()-> donationReqs()->create($request->all());
        $data = $donation->with("blood_type")->with("city")->first();


      $clients_ids = $donation->city->govern->clients()
        ->whereHas("notificate",function($q)use ($request){
       $q->where("blood_types.id",$request->blood_type_id);
       })->pluck("clients.id")->toArray();
         if(count($clients_ids)){


             //add to notification table
             $notification=  $donation->notify()->create(
                 [
                "title"=>"يوجد حالة تحتاج الي تبرع",
                "content"=>  " فصيلة دم ". $data->blood_type->blood_type . " && " ."مدينة ".  $data->city->name,

                ]
                 );

                 // attach notification to client_notification
                 $notification->clients()->attach($clients_ids);


                 $tokens =Token::whereIn("client_id",$clients_ids)->where("token","!=","null")
                 ->pluck("token")->toArray();



                 if(count($tokens)){

                  $title=  $notification->title;
                  $body=  $notification->content;


                  $data =[
                      "donation_req_id"=>$donation->id
                  ];


                  $send= notifyByFirebase($title,$body,$tokens,$data);


                 }


                 return get_response("1", "تمت الاضافة بنجاح",   $clients_ids);


         }else{


            return get_response("1", "  لا يوجد مستخدمين حددو فصيلة الدم او المدينة في الاشعارات",$donation);


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

 $a=$request->user()->notifications()->where('donation_req_id',$donation->id)->first();
 if($a){
$request->user()->notifications()->updateExistingPivot($a->pivot->notification_id, [
   'is_read' => 1
]);
 }

        return get_response("1", "loaded.....  ",$donation);
    }

    /////////////////////////////////////////////////////////////////////////////////////////


    public function notificationList(Request $request){

       $all=  $request->user()->notifications;

       //
        return get_response("1", "loaded.....  ",$all);


    }
}
