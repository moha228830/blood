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
use RealRashid\SweetAlert\Facades\Alert;
class clientsLoginController extends Controller
{

    public function __construct()
    {
     $this->middleware('guest:clients', ['except' => ['logout']]);

    }

    public function showLoginForm()
    {
        return view('front.login');
    }

    public function login(Request $request)
    {

      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in

      if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
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
