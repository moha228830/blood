<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use  App\Models\BloodType;
use  App\Models\City;
use  App\Models\Govern;
use  App\Models\ClientGovern;
use  App\Models\ClientNotification;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\reset_password;

class ClientController extends Controller

{
    public  function register(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'username' => 'required|max:50',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'email' => 'required|email|unique:clients',
            'last_donation' => 'required|before_or_equal:' . now(),
            'date_of_birth' => 'required|before_or_equal:' . now(),
            'city_id' => 'required|numeric',
            'blood_type_id' => 'required|numeric',
            'phone' => 'required|alpha_num|unique:clients',
        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }
        $request->merge(["password" => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token =  $var = Str::random(60);
        $client->save();
        $GLOBALS["c"] = $client->city_id;

        $client = $client->with("blood_type")->with(["city" => function ($q) {
            $q->with("govern")->find($GLOBALS["c"]);
        }])
            ->first();

        return get_response("1", "تمت الاضافة بنجاح", [

            "api_token" => $client->api_token,

            "client" => $client,


        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public  function login(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'password' => 'required',
            'phone' => 'required|alpha_num',
        ]);

        if ($validator->fails()) {
            return get_response("0", "بيانات المستخدم غير صحيحة", $validator->errors());
        }

        $city = Client::where("phone", $request->phone)->first();
        $GLOBALS["c"] = $city->city_id;

        $client = Client::where("phone", $request->phone)->with("blood_type")->with(["city" => function ($q) {
            $q->with("govern")->find($GLOBALS["c"]);
        }])
            ->first();

        $token = $client->api_token;
        $password = $client->password;

        if ($client) {
            if (Hash::check($request->password, $password)) {


                return get_response("1", "تم مصادقة البيانات بنجاح", [

                    "api_token" => $token,

                    "client" => $client,


                ]);
            } else {
                return get_response("0", "بيانات المستخدم غير صحيحة", "    رقم التليفون هذا غير مسجل");
            }
        } else {
            return get_response("0", "بيانات المستخدم غير صحيحة", " كلمة المرور غير صحيحة");
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    public  function resetPassword(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'phone' => 'required|alpha_num',
        ]);

        if ($validator->fails()) {
            return get_response("0", "بيانات المستخدم غير صحيحة", $validator->errors());
        }

        $client =  Client::where("phone", $request->phone)->first();


        if ($client) {
            $pin_code = rand("1111", "9999");

            $client->pin_code = $pin_code;

            $update =  $client->save();
            if ($update == true) {

                $token = $client->api_token;
                $GLOBALS["c"] = $client->city_id;

                $client = Client::where("phone", $request->phone)->with("blood_type")->with(["city" => function ($q) {
                    $q->with("govern")->find($GLOBALS["c"]);
                }])
                    ->first();

                Mail::to($client->email)

                    ->bcc("moha228830@gmail.com")
                    ->send(new reset_password($pin_code));
                return get_response("1", "ادخل كلمة سر جديدة", [

                    "api_token" => $token,

                    "client" => $client,


                ]);
            } else {
                return get_response("0", "حاول مرة اخري", "حاول مرة اخري");
            }
        } else {

            return get_response("0", "بيانات المستخدم غير صحيحة", "    رقم التليفون هذا غير مسجل");
        }
    }
    public  function changPassword(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'pin_code' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }
        $client =  Client::where("pin_code", $request->pin_code)->first();

        if ($client) {
            $client->password =  bcrypt($request->password);
            $client->pin_code = rand("1111", "9999");
            $client->save();

            $token = $client->api_token;
            $GLOBALS["c"] = $client->city_id;

            $client = Client::with("blood_type")->with(["city" => function ($q) {
                $q->with("govern")->find($GLOBALS["c"]);
            }])
                ->first();
            return get_response("1", "تم تحديث البيانات بنجاح", [

                "api_token" => $token,

                "client" => $client,


            ]);
        } else {

            return get_response("0", "كود التفعيل غير صالح", "    كود التفعيل  غير صحيح");
        }
    }


    /////////////////////////////////////////////////////////

    public  function profile(Request $request)
    {
        $validator =  Validator::make($request->all(), [


            'password' => '|confirmed|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            "phone" => 'unique:clients,phone,' . $request->user()->phone,
            "email" => 'unique:clients,email,' . $request->user()->email,
        ]);

        if ($validator->fails()) {
            return get_response("0", $validator->errors()->first(), $validator->errors());
        }

        $loginuser = $request->user();
        $loginuser->update($request->all());
        if ($request->has("password")) {
            $loginuser->password = bcrypt($request->password);
        }
        $loginuser->save();
        $token = $request->user()->api_token;
        $user = $request->user()->fresh()->load("blood_type", "city.govern");
        return get_response("1", "تم تحديث البيانات بنجاح", [

            "api_token" => $token,

            "client" => $user,


        ]);
    }
    public function notificationSetting(Request $request)
    {

        $rules = [
            'governs' => 'exists:governs,id|array',
            'blood_types '  => 'exists:blood_types,id|array',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return get_response(0, $validator->errors()->first(), $validator->errors());
        }

        if ($request->has('governs')) {

            $request->user()->notification()->sync($request->governs);
        }

        if ($request->has('blood_types')) {
            $request->user()->notificate()->sync($request->blood_types);
        }

        $data = [
            'governs' => $request->user()->notification()->pluck('governs.id')->toArray(),

            'blood_types'  => $request->user()->notificate()->pluck('blood_types.id')->toArray(),
        ];
        return get_response(1, 'تم  تحديث البيانات بنجاح', $data);
    }
}
