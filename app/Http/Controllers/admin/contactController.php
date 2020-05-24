<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use App\Models\ContactMesseg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // flash('Welcome Aboard!');

      $contacts = ContactMesseg::with("client")->where(function ($query) use($request){
        if ($request->input('keyword'))
        {
            $query->where(function ($query) use($request){

                $query->WhereHas('client',function ($q) use($request){
                    $q->where('username','like','%'.$request->keyword.'%');
                    $q->orwhere('email','like','%'.$request->keyword.'%');
                    $q->orwhere('phone','like','%'.$request->keyword.'%');
                });

            });
        }

    })->paginate(20);

        return view("/dashboard/contact/index",["contacts"=>  $contacts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

      $contact= ContactMesseg::findOrFail($id);
       $contact->delete();
      if($contact){
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
