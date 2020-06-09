<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\client;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class clientController extends Controller
{


    public function filter(Request $request)
    {
        $clients = Client::with("blood_type")->with("city.govern")->where(function ($query) use($request){

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


        return view("/dashboard/clients/filter",["clients"=>  $clients ]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$clients =  client::with("blood_type")->with("city")->get();
      // flash('Welcome Aboard!');
      // model ,  min , max
     // $clients = Client::whereBetween('created_at', ["2020-05-10 ", "2020-05-22 "])->get();
    //$clients=  btween( client::class,"2020-04-10","2020-05-22");


     // return get_response(1, 'تم  تحديث البيانات بنجاح', $clients);
    // exit();
    $clients = Client::with("blood_type")->with("city.govern")->where(function ($query) use($request){
        if ($request->input('keyword'))
        {
            $query->where(function ($query) use($request){
                $query->where('username','like','%'.$request->keyword.'%');
                $query->orWhere('phone','like','%'.$request->keyword.'%');
                $query->orWhere('email','like','%'.$request->keyword.'%');
                $query->orWhereHas('city',function ($city) use($request){
                    $city->where('name','like','%'.$request->keyword.'%');
                });
            });
        }

        if ($request->input('blood_type_id'))
        {
            $query->where('blood_type_id',$request->blood_type_id);
        }
    })->paginate(20);
        return view("/dashboard/clients/index",["clients"=>  $clients ]);
    }

public  function active ($id)
{
   $client = Client::findOrFail($id);

   $client = $client->update([
       "activity"=> 1
   ]);

   if($client){

       session()->flash('success', "success");
       if(session()->has("success")){
       Alert::success('Success Title', 'Success Message');
       }

         return redirect()->route('clients.index');

   }else{

        session()->flash('error', "error");
       if(session()->has("error")){
       Alert::error('error Title', 'error Message');
       }

         return redirect()->route('clients.index');

   }

}


public  function Inactive ($id)
{
   $client = Client::findOrFail($id);

   $client = $client->update([
       "activity"=> 0
   ]);

   if($client){

       session()->flash('success', "success");
       if(session()->has("success")){
       Alert::success('Success Title', 'Success Message');
       }

         return redirect()->route('clients.index');

   }else{

        session()->flash('error', "error");
       if(session()->has("error")){
       Alert::error('error Title', 'error Message');
       }

         return redirect()->route('clients.index');

   }

}


public  function delete ($id)
{
   $client = Client::findOrFail($id);


     if($client->tokens->count()){$client->tokens()->delete();}

    $client= $client->delete();




   if($client){


       Alert::success('Success Title', 'Success Message');
         return redirect()->route('clients.index');

   }else{


       Alert::error('error Title', 'error Message');
         return redirect()->route('clients.index');

   }

}



}
