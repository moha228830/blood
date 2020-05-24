<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Govern;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class governController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $governs = Govern::where(function ($query) use($request){
        if ($request->input('keyword'))
        {

                $query->where('name','like','%'.$request->keyword.'%');

        }
    })->paginate(15);
      // flash('Welcome Aboard!');



        return view("/dashboard/governs/index",["governs"=>  $governs ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/governs/create');
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

            'name.required'=>"اسم المحافظة مطلوب",


           ];


        $validator =  Validator::make($request->all(), [

            'name' => 'required',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $govern= Govern::create($request->all());
        if ($govern){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('governs.index');

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
       $govern= Govern:: with("cities")->findOrFail($id);

      // dd($govern);
       return view("/dashboard/governs/cities",["govern"=>  $govern ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $govern= Govern::findOrFail($id);
        return view('/dashboard/governs/edit',["govern"=>$govern]);
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

            'name.required'=>"اسم المحافظة مطلوب",


           ];


        $validator =  Validator::make($request->all(), [

            'name' => 'required',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }
        $govern= Govern::findOrFail($id);
        $govern= $govern->update($request->all());
        if ($govern){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('governs.index');

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

      $govern= Govern::findOrFail($id);
      $govern->cities()->delete();
      $govern->delete();
     // session()->flash('success', __('site.deleted_successfully'));
     session()->flash('success', "success");
     if(session()->has("success")){
      Alert::success('Success Title', 'Success Message');
     }
      return redirect()->route('governs.index');

    }
}
