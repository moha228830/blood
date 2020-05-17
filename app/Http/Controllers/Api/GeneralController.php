<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use  App\Models\BloodType;
use  App\Models\ContactMesseg;
use  App\Models\City;
use  App\Models\Govern;
use  App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function cities(Request $request)
    {


        $validator =  Validator::make($request->all(), [

            'govern_id' => 'required|Numeric|exists:App\Models\govern,id',

        ]);


        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }
        $govern = $request->govern_id;
        $cities = City::where("govern_id", $govern)->latest()->paginate(10);


        return get_response("1", "loaded...  ", $cities);
    }




     /////////////////////////////////////////////////////////////////////////////////




    public function govern(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'id' => 'required|Numeric|exists:App\Models\govern,id',

        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }


        $governs = Govern::with("cities")->latest()->paginate(10);


        return get_response("1", "loaded...  ", $governs);
    }



     /////////////////////////////////////////////////////////////////////////////////



    public function governs()
    {
        $governs = Govern::latest()->paginate(5);
        return get_response("1", "loaded...  ", $governs);
    }






    /////////////////////////////////////////////////////////////////////////////////////////



    public function bloodTypes()
    {
        $bloodTypes = bloodType::get();
        return get_response("1", "loaded...  ", $bloodTypes);
    }



    /////////////////////////////////////////////////////////////////////////////////




    public function setting()
    {
        $setting = Setting::get()->first();
        return get_response("1", "loaded...  ", $setting);
    }




    /////////////////////////////////////////////////////////////////////////////////////////



    public function contact(Request $request)
    {

        $messeges = [

            'title.required'=>"  ادخل العنوان ",
            'content.required'=>"   ادخل المحتوي",

           ];

        $validator =  Validator::make($request->all(), [

            'title' => 'required',
            'content' => 'required',

        ],  $messeges);


        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }


        $contact = ContactMesseg::create($request->all());
        if ($contact) {

            return get_response("0", " تم الارسال بنجاح      ", $contact);


        } else {

            return get_response("0", "فشل في الارسال حاول مرة اخري  ", "فشل في الارسال حاول مرة اخري  ");
        }
    }
}
