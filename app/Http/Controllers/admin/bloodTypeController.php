<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\BloodType;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class bloodTypeController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $bloodTypes =  bloodType::get();
      // flash('Welcome Aboard!');



        return view("/dashboard/bloodTypes/index",["bloodTypes"=>  $bloodTypes ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/bloodTypes/create');
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

            'blood_type.required'=>"اسم فصيلة الدم مطلوب",
            'blood_type.unique'=>"اسم فصيلة الدم موجود من قبل",

           ];


        $validator =  Validator::make($request->all(), [

            'blood_type' => 'required|unique:blood_types',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $bloodType= bloodType::create($request->all());
        if ($bloodType){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('bloodTypes.index');

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
        $bloodType= bloodType::findOrFail($id);
        return view('/dashboard/bloodTypes/edit',["bloodType"=>$bloodType]);
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

            'blood_type.required'=>"اسم فصيلة الدم مطلوب",
            'blood_type.unique'=>"اسم فصيلة الدم موجود من قبل",


           ];


        $validator =  Validator::make($request->all(), [

            'blood_type' => 'required|unique:blood_types,blood_type,' .$id,

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }
        $bloodType= bloodType::findOrFail($id);
        $bloodType= $bloodType->update($request->all());
        if ($bloodType){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('bloodTypes.index');

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



    }
}
