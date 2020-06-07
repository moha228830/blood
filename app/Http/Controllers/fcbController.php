<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Token;

class fcbController extends Controller
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = env('FIREBASE_API_ACCESS_KEY');
    }

    public function saveToken (Request $request)
    {
        $rules = [
            'token' => 'required',

        ];


        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            echo "no register";
            exit();
        }


        Token::where("token",$request->token)->delete();
        $save= $request->user()->tokens()->create($request->all());



        if($save){
           echo "success save token";
        }
         else{
             echo "error save token";
         }
    }

    public function sendPush (Request $request)
    {
        $Client = Client::find($request->id);
        $data = [
            "to" => $Client->device_token,
            "notification" =>
                [
                    "title" => 'Web Push',
                    "body" => "Sample Notification",
                    "icon" => url('/logo.png')
                ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        curl_exec($ch);

        return redirect('/home')->with('message', 'Notification sent!');
    }
}
