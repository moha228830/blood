<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\City;
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
//dd( $donation_reqs);
return view('front.donation-details',["donation_reqs"=>$donation_reqs]);

    }



//////////////////////////////////////////////////////////////////////////

    public function toggle_favourite(Request $request)
    {

        $toggle =auth()->guard('clients')->user()->favorite()->toggle($request->post_id);
        return get_response("1", "success",$toggle);
    }





//////////////////////////////////////////////////////////////////////////////

    public function sine_up()
    {
        return view('front.register');
    }


    /////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////

public function login()
{
    return view('front.login');
}


/////////////////////////////////////////////////////



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





}
