<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\client;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$clients =  client::with("blood_type")->with("city")->get();
      // flash('Welcome Aboard!');

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

   if( $client->donationReqs->count()){

    session()->flash('error', "error");
    if(session()->has("error")){
    Alert::error('error', 'يوجد طلبات تبرع مرتبطة بالحقل احذفها اولا');

    return back();
    }

   }else{


     if($client->contacts->count()){$client->contacts()->delete();}


     if($client->notifications->count()){$client->notifications()->delete();}
     if($client->tokens->count()){$client->tokens()->delete();}
     if($client->donationReqs->count()){$client->donationReqs()->delete();}
     $client->delete();
     session()->flash('success', "success");
       if(session()->has("success")){
       Alert::success('Success Title', 'Success Message');
       }

         return redirect()->route('clients.index');

   }


   if($client){

       session()->flash('success', "success");
       if(session()->has("success")){
       Alert::success('Success Title', 'Success Message');
       }

         return redirect()->route('clients.index');

   }else{

        session()->flash('error', "error");
       if(session()->has("error")){
       Alert::success('error Title', 'error Message');
       }

         return redirect()->route('clients.index');

   }

}

}
