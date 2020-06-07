<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Token;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    ///////////////////////////////////////////////////////////////////////
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts= Post::take(12)->get() ;
        $donation_reqs =  \DB::table("donation_reqs")
        ->leftJoin('blood_types', 'blood_types.id', '=', 'donation_reqs.blood_type_id')
        ->leftJoin('cities', 'cities.id', '=', 'donation_reqs.city_id')
        ->select(

\DB::raw("donation_reqs.id as donation_id"),
\DB::raw("blood_types.blood_type"),
\DB::raw("donation_reqs.patient_name "),
\DB::raw("donation_reqs.id as donation_id "),
\DB::raw("donation_reqs.hospital_name as hospital"),
\DB::raw("cities.name"),
)->where(function ($q) use($request){

    if ($request->input('city') )
    {
        $q->where('cities.id',$request->city);
    }
    if ($request->input('blood') )
    {
        $q->where('blood_types.id',$request->blood);
    }

    })

->paginate(8);
        return view('home',["donation_reqs"=>$donation_reqs ,"posts"=>$posts]);
    }




    //////////////////////////////////////////////////////////////////////////////





    public function donation(Request $request)
    {
        $donation_reqs =  \DB::table("donation_reqs")
        ->leftJoin('blood_types', 'blood_types.id', '=', 'donation_reqs.blood_type_id')
        ->leftJoin('cities', 'cities.id', '=', 'donation_reqs.city_id')
        ->select(

\DB::raw("donation_reqs.id as donation_id"),
\DB::raw("blood_types.blood_type"),
\DB::raw("donation_reqs.patient_name "),
\DB::raw("donation_reqs.id as donation_id "),
\DB::raw("donation_reqs.hospital_name as hospital"),
\DB::raw("cities.name"),
)->where(function ($q) use($request){

    if ($request->input('city') )
    {
        $q->where('cities.id',$request->city);
    }
    if ($request->input('blood') )
    {
        $q->where('blood_types.id',$request->blood);
    }

    })

->paginate(8);
        return view('front.donation',["donation_reqs"=>$donation_reqs]);
    }




    /////////////////////////////////////////////////////////////////////////




    public function donation_details(Request $request,$id)
    {
        $donation_reqs =  \DB::table("donation_reqs")
        ->leftJoin('blood_types', 'blood_types.id', '=', 'donation_reqs.blood_type_id')
        ->leftJoin('cities', 'cities.id', '=', 'donation_reqs.city_id')
        ->select(

\DB::raw("donation_reqs.id as donation_id"),
\DB::raw("blood_types.blood_type"),
\DB::raw("donation_reqs.*"),
\DB::raw("donation_reqs.patient_name "),
\DB::raw("donation_reqs.id as donation_id "),
\DB::raw("donation_reqs.hospital_name as hospital"),
\DB::raw("cities.name"),
)->where("donation_reqs.id",$id)->first();



$a=auth()->guard('clients')->user()->notifications()->where('donation_req_id',$donation_reqs->donation_id)->first();
 if($a){
    auth()->guard('clients')->user()->notifications()->updateExistingPivot($a->pivot->notification_id, [
   'is_read' => 1
]);
 }
return view('front.donation-details',["donation_reqs"=>$donation_reqs]);

    }



//////////////////////////////////////////////////////////////////////////

    public function toggle_favourite(Request $request)
    {

        $toggle =auth()->guard('clients')->user()->favorite()->toggle($request->post_id);
        return get_response("1", "success",$toggle);
    }








    /////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////





public function posts(Request $request)
{
    $posts= Post::where(function ($q) use($request){

        if ($request->input('cat') )
        {
            $q->where('category_id',$request->cat);
        }
    })->paginate(12) ;
    return view('front.posts',["posts"=>$posts]);
}


public function post($id)
{
    $post= Post::find($id) ;
    return view('front.post',["post"=>$post]);
}



public function test()
{
    $tokens =["c2WLmV6mWWE6_4ujl-5DvI:APA91bFNEfpQ0DwfeDDzF8AstrL81DRE5ELV-rt56b4zJR22_HbBNIRNpKOhlzXntxIMkBYmajjzlKA4gKfBoT2h8CWQzIw7il64Aa0DHwc2tW4d43cxntfaa9xsIrvc72FxUY4hkE3M"];

  $send= notifyByFirebase("moha","moha", $tokens,null,$is_notification=true);
  dd($send);
    $users= Client::get() ;
    return view('front.test',["users"=>$users]);
}




public function add_donation()
{
    return view('front.add_donation');
}

public function save_donation(Request $request)
{
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
           // 'longitude' => 'required',
            //'latitude' => 'required',
            'patient_phone' => 'required',
            "hospital_address"=>'required',
        ],$messeges);



        if ($validator->fails()) {
            Alert::error('error',$validator->errors()->first());
             return back();

        }



        $donation =$request->user()-> donationReqs()->create($request->all());
        $data = $donation->with("blood_type")->with("city")->first();


        $govern_id = $donation->city->govern->id;
     $clients_ids_goveern = $donation->city->govern->clients()
     ->whereHas("notification",function($q)use ($govern_id){
      $q->where("governs.id",$govern_id);
       })->pluck("clients.id")->toArray();
       $clients_ids_blood_type = $donation->blood_type->clients()
       ->whereHas("notificate",function($q)use ($request){
         $q->where("blood_types.id",$request->blood_type_id);
        })->pluck("clients.id")->toArray();
     foreach($clients_ids_goveern as $value) {
          if(!in_array($value, $clients_ids_blood_type)){
            array_push( $clients_ids_blood_type,$value);
          }
      }
      $clients_ids= $clients_ids_blood_type;


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

                 Alert::success('success', "تمت الاضافة بنجاح وارسال الاشعارات");
                 return back();



         }else{


            Alert::success('success', "تمت الاضافة بنجاح  ولايوجد اشعارات محددة بهذه التفاصيل");
                 return back();

         }
    }
}


public function notification_setting()
{
    return view('front.notification_setting');
}


public function notification(Request $request)
{
    $all=  $request->user()->notifications;
    return view('front.notification',["all"=>$all]);
}

public function notificationSetting(Request $request)
    {

        $rules = [
            'governs' => 'exists:governs,id|array',
            'blood_types '  => 'exists:blood_types,id|array',
        ];


        $messeges = [

            'governs.exists'=>"خطأ اخترت محافة غير موجودة",


            'blood_types.exists'=>"خطأ  اخترت فصيلة دم غير موجودة",

           ];


        $validator = validator()->make($request->all(), $rules,$messeges);
        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
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


        Alert::success('success', "تم الحفظ بنجاح");
        return back();
    }



}
