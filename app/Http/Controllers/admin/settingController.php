<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use App\Models\ContactMesseg;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      // flash('Welcome Aboard!');

      $setting = Setting::first();


        return view("/dashboard/settings/index",["setting"=>  $setting  ]);
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
    public function update(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'about_app' => 'required',
            'setting_notification_text' => 'required',
            'tw_link' => 'required',
            'fb_link' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'insta_link' => 'required',
            'yt_link' => 'required',


        ]);



        if ($validator->fails()) {
            Alert::error('error', "من فضلك ادخل الحقول الفارغة");
            return back();
        }


        $setting = Setting::first();
        if( $setting){
            $setting= $setting->update($request->all());

                 if($setting){

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
        }else{

                $setting= Setting::create($request->all());
                if($setting){

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
