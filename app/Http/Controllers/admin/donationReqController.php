<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\donationReq;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class donationReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     //  $donationReqs =  DB::table("donation_reqs")->select(

    // DB::raw("COUNT(*) as count "),
    // DB::raw("MONTH(created_at) as month ")
     //)->groupBy("month")->havingRaw("count !=?",["1"])->get();

        //return get_response(1, 'تم  تحديث البيانات بنجاح', $donationReqs);
      // flash('Welcome Aboard!');

      $donationReqs = donationReq::with("blood_type")->with("city.govern")->where(function ($query) use($request){
        if ($request->input('keyword'))
        {
            $query->where(function ($query) use($request){
                $query->where('patient_name','like','%'.$request->keyword.'%');
                $query->orWhere('patient_phone','like','%'.$request->keyword.'%');
                $query->orWhereHas('city',function ($city) use($request){
                    $city->where('name','like','%'.$request->keyword.'%');
                });
                $query->orWhereHas('client',function ($q) use($request){
                    $q->where('username','like','%'.$request->keyword.'%');
                });
            });
        }

        if ($request->input('blood_type_id'))
        {
            $query->where('blood_type_id',$request->blood_type_id);
        }
    })->paginate(20);

        return view("/dashboard/donationReqs/index",["donationReqs"=>  $donationReqs ]);
    }

    public function filter(Request $request)
    {
       //$donationReqs =  donationReq::with("blood_type")->with("city")->get();
      // flash('Welcome Aboard!');

      $donationReqs = donationReq::with("blood_type")->with("city.govern")->where(function ($query) use($request){

        if ($request->input('from') && $request->input('to'))

        {
            if($request->input('to') >= $request->input('from')){
            $query->whereBetween('created_at', [$request->input('from'), $request->input('to')]);
            }
            if($request->input('to') <= $request->input('from')){
                $query->whereBetween('created_at', [$request->input('to'), $request->input('from')]);
                }
        }



        if ($request->input('blood_type_id'))
        {
            $query->where('blood_type_id',$request->blood_type_id);
        }

        if ($request->input('city_id'))
        {
            $query->WhereHas('city',function ($city) use($request){
                $city->where('city_id',$request->city_id);
            });
        }
        if ($request->input('govern_id'))
        {
            $query->WhereHas('city.govern',function ($govern) use($request){
                $govern->where('govern_id',$request->govern_id);
            });
        }
    })->paginate(20);

        return view("/dashboard/donationReqs/filter",["donationReqs"=>  $donationReqs ]);
    }



public  function destroy ($id)
{
   $donationReq = donationReq::findOrFail($id);
   if($donationReq->notify->count()){

    $donationReq->notify->delete();
   }

   $donationReq=$donationReq->delete();
   if($donationReq){
    session()->flash('success', "success");
    if(session()->has("success")){
     Alert::success('Success Title', 'Success Message');
     return back();

   }
}else{
    session()->flash('error', "error");
    if(session()->has("error")){
     Alert::error('error Title', 'error Message');
     return back();

   }


}
}
}

