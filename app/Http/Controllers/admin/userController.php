<?php

namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class userController extends Controller
{




    public function index(Request $request)

    {



        $users = User::where(function ($query) use($request){
            if ($request->input('keyword'))
            {
                $query->where(function ($query) use($request){
                    $query->where('name','like','%'.$request->keyword.'%');
                    $query->orWhere('email','like','%'.$request->keyword.'%');


                });
            }

            if ($request->input('role_id'))
            {
                $query->WhereHas('rouls',function ($q) use($request){
                    $q->where('display_name','like','%'.$request->keyword.'%');
                });
            }
        })->paginate(20);

        return view('dashboard/users/index',compact('users'));
    }

    public function create(User $model)
    {
        return view('/dashboard/users/create',compact('model'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        dd();
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|confirmed',
            'email' => 'email',//required
            'roles_list'  => 'required'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));

        Alert::success('success','تــم اضــافة المستخدم بنجــاح');
        return back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard/users.edit',compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request , $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'confirmed',
            'email' => 'email',//|required|unique:users,email,'.$id
            'roles_list'  => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->roles()->sync((array) $request->input('roles_list'));
        $request->merge(['password' => bcrypt($request->password)]);

       if($request->password ==""){

        $update = $user->update(["name"=>  $request->name ,
        "email"=> $request->email

        ]);
       }else{

        $update = $user->update(["name"=>  $request->name ,
        "email"=> $request->email,
        "password"=>$request->password

        ]);

       }

        if($update ){
        Alert::success('success','تــم تحديث المستخدم بنجــاح');
        return back();
        }else{
            Alert::error('error','   error');
            return back();
        }
    }

    public function destroy($id)
    {
        $record = User::findOrFail($id);

        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }

        $record->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
    }
}
