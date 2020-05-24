<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      // flash('Welcome Aboard!');

      $categories = Category::where(function ($q) use ($request) {
        if ($request->search) {
            $q->where('category', 'LIKE', '%' . $request->search . '%');
        }
    })->paginate(10);

        return view("/dashboard/categories/index",["categories"=>  $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/categories/create');
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

            'category.required'=>"اسم الموضوع مطلوب",
            'category.unique'=>"اسم الموضوع موجود من قبل",


           ];


        $validator =  Validator::make($request->all(), [

            'category' => 'required|unique:categories',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $category= Category::create($request->all());
        if ($category){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('categories.index');

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
        $category= Category::findOrFail($id);
        return view('/dashboard/categories/edit',["category"=>$category]);
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

            'category.required'=>"اسم الموضوع مطلوب",
            'category.unique'=>"اسم الموضوع موجود من قبل",


           ];


       //  dd( $category);
        $validator =  Validator::make($request->all(), [

            'category' => 'required|unique:categories,category,' .$id,

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }
        $category= category::findOrFail($id);
        $category= $category->update($request->all());
        if ($category){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('categories.index');

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

      $category= category::with("posts")->findOrFail($id);

      if(count($category->posts) != 0){
        Alert::error('error', "يجب عليك اولا ان تحذف البيانات المتعلقة بالحقل في المقالات ");
        return back();

      }
      $category->posts()->delete();
      $category->delete();
     // session()->flash('success', __('site.deleted_successfully'));
     session()->flash('success', "success");
     if(session()->has("success")){
      Alert::success('Success Title', 'Success Message');
     }
      return redirect()->route('categories.index');

    }
}
