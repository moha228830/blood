<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use  App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\reset_password;
use App\Models\Govern;
use RealRashid\SweetAlert\Facades\Alert;
class clientsLoginController extends Controller
{

    public function __construct()
    {
     $this->middleware('guest:clients', ['except' => ['logout',"profile","profile_save"]]);

    }

    public function showLoginForm()
    {
        return view('front.login');
    }

    public function login(Request $request)
    {

      // Validate the form data
      $this->validate($request, [
        'phone'   => 'required',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in

      if (Auth::guard('clients')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('home'));

      }

      // if unsuccessful, then redirect back to the login with the form data
      Alert::error('error', "تاكد من بيانات حسابك");
      return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('clients')->logout();
        return redirect(route("home"));
    }



    public function reset()
    {

        return view('front.reset');
    }


    public function pin_code(Request $request)
    {
        $messeges = [

            'password.required'=>"حقل كلمة المرور مطلوب",
            'password.min'=>"كلمة المرور لا تقبل اقل من 6 علامات",
            'password.confirmed'=>"كلمة المرور غير متطابقة",

            'pin_code.required'=>"كود التحقق مطلوب",

           ];


        $validator =  Validator::make($request->all(), [

            'pin_code' => 'required',
            'password' => 'required|confirmed|min:6',

        ], $messeges);



        if ($validator->fails()) {

            Alert::error('error Title', $validator->errors());
            return back();
        }



        $client =  Client::where("pin_code", $request->pin_code)->first();

        if ($client) {
            $phone =  $client->phone;
            $client->password =  bcrypt($request->password);
            $client->pin_code = null;
            $client->save();


            Alert::success('success Title', 'تمت العملية بنجاح قم بتسجيل الدخول ');
            return view('front.login');




        } else {
            Alert::error('error Title', "كود التفعيل غير صالح");
            return back();

        }
    }



    public function profile()
    {

     $client= Auth::guard('clients')->user();


        return view('front.profile',["client"=>$client]);
    }

    public function profile_save(Request $request)
    {

        $messeges = [

            'password.min'=>"كلمة المرور الجديدة لا تقبل اقل من 6 علامات",
            'password.required'=>"كلمة المرور القديمة مطلوبة مع كلمة المرور الجديدة ",
            'password_old.required'=>"كلمة المرور الجديدة مطلوبة مع كلمة المرور القديمة ",
            'password.confirmed'=>"كلمة المرور غير متطابقة",

            'email.email'=>"الايميل غير صالح",
            'email.unique'=>"الايميل موجود من قبل",

            'phone.unique'=>"رقم التليفون موجود من قبل",
           ];



           if ($request->password !="" or $request->password_old !="" ){


            $password=Auth::guard('clients')->user()->password;

             if( !Hash::check($request->password_old, $password))
             {
                Alert::error('error', "كلمة المرور القديمة غير صحيحة");

                return back();
             }

        $validator =  Validator::make($request->all(), [

            'password_old'=>"required_with:password",
            'password' => 'confirmed|min:6|required_with:password_old',
            "phone" => 'unique:clients,phone,' . $request->user()->id,
            "email" => 'email|unique:clients,email,' . $request->user()->id,
        ], $messeges);




           }else{

            $validator =  Validator::make($request->all(), [



                "phone" => 'unique:clients,phone,' . $request->user()->id,
                "email" => 'email|unique:clients,email,' . $request->user()->id,
            ], $messeges);

         }

        if ($validator->fails()) {

            Alert::error('error', $validator->errors()->first());

            return back();
        }


        $loginuser = $request->user();
        $save1=$loginuser->update($request->except(['password_old',"password"]));
        if ($request->has("password") and $request->password != "") {
            $loginuser->password = bcrypt($request->password);
        }
        $save2=  $loginuser->save();
        if($save1 and $save2){
            Alert::success('success', 'success');

            return back();
        }else{
            Alert::error('error', 'خطأ غير متوقع حاول مرة اخري');

            return back();
        }


    }



    public function forget()
    {

        return view('front.forget');
    }




    public function send(Request $request)
    {
        $messeges = [
            'phone.required'=>"حقل رقم التليفون فارغ ",

           ];


        $validator =  Validator::make($request->all(), [

            'phone' => 'required',
        ],$messeges);



        if ($validator->fails()) {

            Alert::error('error Title', 'حاول مرة اخري ');
            return back();
        }



        $client =  Client::where("phone", $request->phone)->first();


        if ($client) {
            $pin_code = rand("1111", "9999");

            $client->pin_code = $pin_code;

            $update =  $client->save();


            if ($update == true) {

                $token = $client->api_token;





                Mail::to($client->email)

                    ->bcc("moha228830@gmail.com")
                    ->send(new reset_password($pin_code));
                    Alert::success('success Title', 'ادخل كلمة مرور جديدة ');
                    return view('front.reset');


            } else {

                Alert::error('error Title', 'حاول مرة اخري ');
                return back();
            }
        } else {


            Alert::error('error Title', 'حاول مرة اخري ');
            return back();
        }
    }


    //////////////////////////////////////////////////////////////////////////////

    public function sine_up()
    {
        return view('front.register');
    }

    public function  sine_up_submit(Request $request)
    {
        $messeges = [
            'username.required'=>"حقل الاسم مطلوب",
            'username.max'=>"عدد احرف الاسم اكبر من 60 حرف",
            'username.min'=>"عدد احرف الاسم اقل من 4 احرف",
            'password.required'=>"حقل كلمة المرور مطلوب",
            'password.min'=>"كلمة المرور لا تقبل اقل من 6 علامات",
            'password.confirmed'=>"كلمة المرور غير متطابقة",
            'email.required'=>"حقل الايميل مطلوب",
            'email.email'=>"الايميل غير صالح",
            'email.unique'=>"الايميل موجود من قبل",
            'last_donation.required'=>"حقل تاريخ اخر تبرع مطلوب",
            'last_donation.before_or_equal'=>"وقت اخر تبرع يتخطي الوقت الحاضر",
            'date_of_birth.required'=>"حقل تاريخ الميلاد مطلوب",
            'date_of_birth.before_or_equal'=>"تاريخ الميلاد غير صالح",
            'city_id.required'=>"لم تقم باختيار مدينة",
            'city_id.numeric'=>"المدينة غير موجودة",
            'blood_type_id.required'=>"لم تقم باختيار فصيلة دم",
            'blood_type_id.numeric'=>"فصيلة الدم غير موجودة",
            'phone.required'=>"حقل رقم التليفون فارغ ",
            'phone.unique'=>"رقم التليفون موجود من قبل",

           ];

        $validator =  Validator::make($request->all(), [
            'username' => 'required|max:60|min:4',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:clients',
            'last_donation' => 'required|before_or_equal:' . now(),
            'date_of_birth' => 'required|before_or_equal:' . now(),
            'city_id' => 'required|numeric',
            'blood_type_id' => 'required|numeric',
            'phone' => 'required|unique:clients',
        ], $messeges);


        if ($validator->fails()) {
            return back();
        }


        $request->merge(["password" => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token =  $var = Str::random(60);
        $save=$client->save();
        if($save){
            Alert::success('Success Title', 'تم التسجيل بنجاح قم بتسجيل الدخول');
            return redirect()->route('client_login');
        }
        return back();
        Alert::success('error Title', 'حاول مرة اخري ');
    }
}
