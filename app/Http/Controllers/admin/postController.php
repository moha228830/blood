<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Post;
use  App\Models\Category;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = post::with("category")->where(function ($query) use($request){
            if ($request->input('keyword'))

                {
                    $query->where(function ($query) use($request){
                        $query->where('title','like','%'.$request->keyword.'%');
                        $query->orWhereHas('category',function ($q) use($request){
                            $q->where('category','like','%'.$request->keyword.'%');
                        });


                    });
                }
                if ($request->input('category_id'))
                {
                    $query->where('category_id',$request->category_id);
                }
        })->paginate(15);
      // flash('Welcome Aboard!');



        return view("/dashboard/posts/index",["posts"=>  $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= category::get();
        return view('/dashboard/posts/create',["categories"=>$categories]);
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

            'img.required'=>"صورة المقال مطلوبة",
            'img.mimes'=>" يجب ان تكون الصورة jpg او jpeg او png او gif",
            'img.max'=>" الحد الاقصي للصورة 4 ميجا ",
            'title.required'=>"عنوان المقال مطلوب",
            'content.required'=>"محتوي المقال مطلوب",
            'govern_id.required'=>" الموضوع مطلوب",


           ];


        $validator =  Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'img' => 'required|mimes:jpg,jpeg,png,gif|max:4100',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

       $img = $request->img;
       $title= $request->title;
       $content = $request->content;
       $cat_id = $request->category_id;

       //add new name for img
       $new_name_img = time().".".$img->getClientOriginalExtension();

       //move img to folder
       $img->move(public_path("upload"), $new_name_img);

        $post= Post::create([
       "img"=>  "upload/".$new_name_img ,
       "title"=>  $title ,
       "content"=>  $content ,
       "category_id"=> $cat_id
        ]);
        if ($post){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('posts.index');

        }else{

            session()->flash('error', "error");
            if(session()->has("error")){
               Alert::success('error Title', 'error Message');
            }

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
        $post= post::with("category")->findOrFail($id);

        $categories= Category::get();
        return view('/dashboard/posts/edit',["post"=>$post,"categories"=>$categories]);
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


            'img.mimes'=>" يجب ان تكون الصورة jpg او jpeg او png او gif",
            'img.max'=>" الحد الاقصي للصورة 4 ميجا ",
            'title.required'=>"عنوان المقال مطلوب",
            'content.required'=>"محتوي المقال مطلوب",
            'govern_id.required'=>" الموضوع مطلوب",


           ];


        $validator =  Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'img' => 'mimes:jpg,jpeg,png,gif|max:4100',

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }
if($_FILES["img"]["name"] != ""){
       $img = $request->img;
       $title= $request->title;
       $content = $request->content;
       $cat_id = $request->category_id;

       //add new name for img
       $new_name_img = time().".".$img->getClientOriginalExtension();

       //move img to folder
       $img->move(public_path("upload"), $new_name_img);
       $post=Post::findOrFail($id);
        $post=  $post->update([
       "img"=>  "upload/".$new_name_img ,
       "title"=>  $title ,
       "content"=>  $content ,
       "category_id"=> $cat_id
        ]);

}else{


    $title= $request->title;
    $content = $request->content;
    $cat_id = $request->category_id;

    $post=Post::findOrFail($id);
    $post=  $post->update([
    "title"=>  $title ,
    "content"=>  $content ,
    "category_id"=> $cat_id
     ]);


}
        if ($post){

            session()->flash('success', "success");
         if(session()->has("success")){
            Alert::success('Success Title', 'Success Message');
         }

            return redirect()->route('posts.index');

        }else{

            session()->flash('error', "error");
            if(session()->has("error")){
               Alert::success('error Title', 'error Message');
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

      $post= Post::findOrFail($id);
      $post->delete();
     // session()->flash('success', __('site.deleted_successfully'));
     session()->flash('success', "success");
     if(session()->has("success")){
      Alert::success('Success Title', 'Success Message');
     }
      return redirect()->route('posts.index');

    }
}
