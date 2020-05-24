<?php

namespace App\Http\Controllers\admin;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $records = Role::paginate(10);

        return view('/dashboard/roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/roles.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'الاسم مطلوب',
            'display_name.required' => 'الاسم المعروض مطلوب',
            'permissions_list.required' => 'اختيار الصلاحيات مطلوب'
        ];
        $this->validate($request,$rules,$messages);
        $record = Role::create($request->all());
        $record->permissions()->attach($request->permissions_list);

        Alert::success('success','تــم اضــافة الرتبة بنجــاح');
        return redirect(route('roles.index'));
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
        $record = Role::findOrFail($id);
        return view('dashboard/roles.edit',compact('record'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:roles,name,'.$id,
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'display_name.required' => 'Display Name is required',
            'permissions_list.required' => 'Permissions is required'
        ];
        $this->validate($request,$rules,$messages);
        $record = Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);

        Alert::success('success','تم التحديث بنجاح');
        return redirect(route('roles.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Role::findOrFail($id);


        $record->delete();
        Alert::success('success','تم الحذف بنجاح');

       return back();

    }

}
