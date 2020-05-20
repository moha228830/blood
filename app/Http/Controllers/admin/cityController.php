<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\city;
use  App\Models\Govern;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class cityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $cities =  city::with("govern")->get();
      // flash('Welcome Aboard!');



        return view("/dashboard/cities/index",["cities"=>  $cities ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governs= Govern::get();
        return view('/dashboard/cities/create',["governs"=>$governs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messeges = [

            'name.required'=>"اسم المدينة مطلوب",
            'govern_id.required'=>" المحافظة مطلوبة",


           ];


        $validator =  Validator::make($request->all(), [

            'name' => 'required',
            'govern_id' => 'required',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $city= city::create($request->all());
        if ($city){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('cities.index');

        }

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
        $city= city::with("govern")->findOrFail($id);

        $governs= Govern::get();
        return view('/dashboard/cities/edit',["city"=>$city,"governs"=>$governs]);
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
         $messeges = [

            'name.required'=>"اسم المدينة مطلوب",
            'govern_id.required'=>" المحافظة مطلوبة",



           ];


        $validator =  Validator::make($request->all(), [

            'name' => 'required',
            'govern_id' => 'required',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }
        $city= city::findOrFail($id);
        $city= $city->update($request->all());
        if ($city){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('cities.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

      $city= city::findOrFail($id);
      $city->delete();
     // session()->flash('success', __('site.deleted_successfully'));
     session()->flash('success', "success");
     if(session()->has("success")){
      Alert::success('Success Title', 'Success Message');
     }
      return redirect()->route('cities.index');

    }
}
