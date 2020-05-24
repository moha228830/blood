<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use App\Models\ContactMesseg;
use App\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      // flash('Welcome Aboard!');

      $profile = User::first();


        return view("/dashboard/profile/index",["profile"=>  $profile  ]);
    }


    public function username(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            'name' => 'required',




        ]);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }


        $profile = $request->user();

            $profile= $profile->update(["name"=>$request->name]);

                 if($profile){

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


    //////////////////////////////////////////////////////////////////




    public function password(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            "old"=>"required",
            'password' => 'required|confirmed',



        ]);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        if (!Hash::check($request->old, $request->user()->password)) {

            Alert::error('error', "    كلمة المرور القديمة غير صحيحة");
            return back();
        }

        $profile = $request->user();
          $password = bcrypt($request->password);
        $profile= $profile->update(["password"=>$password]);

             if($profile){

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



    ///////////////////////////////////////////////////////////////////////////////





    public function email(Request $request)
    {

        $validator =  Validator::make($request->all(), [


            'email' => 'required|email|unique:users,email,' . $request->user()->id,




        ]);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }


        $profile = $request->user();

            $profile= $profile->update(["email"=>$request->email]);

                 if($profile){

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
