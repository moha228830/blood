<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    public function categories(){
        $categories = Category::latest()->get();

        return get_response("1","loaded...  ",$categories);


        }

       public function posts (Request $request){

        $validator =  Validator::make($request->all(), [

            'category_id' => 'required|Numeric|exists:App\Models\Category,id',

        ]);

        if ($validator->fails()) {
            return get_response("0",$validator->errors()->first(),$validator->errors());
        }

        $posts = Post::where("category_id",$request->category_id)->latest()->paginate(10);
        return get_response("1","loaded...  ",$posts);


        }


        public function post (Request $request){

            $validator =  Validator::make($request->all(), [

                'id' => 'required|Numeric|exists:App\Models\Post,id',

            ]);

            if ($validator->fails()) {
                return get_response("0",$validator->errors()->first(),$validator->errors());
            }

            $post = Post::find($request->id);
            return get_response("1","loaded...  ",$post);


            }




            public function favorite (Request $request){

                $validator =  Validator::make($request->all(), [

                    'post_id' => 'required|Numeric|exists:App\Models\Post,id',

                ]);

                if ($validator->fails()) {
                    return get_response("0",$validator->errors()->first(),$validator->errors());
                }

                $favorite =$request->user()->favorite()->toggle($request->post_id);
                return get_response("1","تمت العملية بنجاح  ", $favorite);


                }


                public function myFavorite (){



                    $favorite = request()->user()->favorite()->latest()->paginate(5);
                    return get_response("1"," loaded...   ", $favorite);


                    }



}
