@extends('front.master')
@section('title')
المقال
@endsection
@section('content')

   <!-- articles -->
   <section id="articles" style="margin-bottom: 20px">
    <h2 class="donations-head horizntal-line"> {{$post->title}} </h2>
    <div class="container custom" style="direction: ltr">






                <div class="item">
                    <div class="card" >
                        @if(auth()->guard('clients')->user())
                        <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="fab fa-gratipay


                            {{$post->is_favori ? 'second-heart' : 'first-heart'}}

                            "></i>
                            @endif
                                                        <!---<i  class="fab fa-gratipay second-heart"></i>-->

                        <img style="max-height:400px " class="card-img-top" src="{{asset($post->img)}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->content}}</p>

                        </div>
                    </div>
                </div>





    </div>

</section>

@php
   $posts =\DB::table('posts')->where("category_id",$post->category_id)->where("id","!=",$post->id)->get();

@endphp

<section id="articles" style="margin-bottom: 20px">
    <h2 class="donations-head horizntal-line"  style="padding:5px"> مقالات ذات صلة </h2>
    <br>
    <div class="container custom" style="direction: ltr">
        <div class="owl-carousel owl-theme" id="owl-articles" >



            @foreach($posts as $post)

                <div class="item" >
                    <div class="card" style="width: ;">
                        @if(auth()->guard('clients')->user())
                            <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="fab fa-gratipay


                                {{$post->is_favori ? 'second-heart' : 'first-heart'}}

                                "></i>
                                @endif
                                                        <!---<i  class="fab fa-gratipay second-heart"></i>-->

                                                        <img style="height: 300px;width:300px" class="card-img-top" src="{{asset($post->img)}}" alt="Card image cap">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$post->title}}</h5>
                                                            <p class="card-text">{{substr($post->content,0,200)}}

                                                            </p>
                            <a href="{{url(route('client_post',$post->id))}}">
                                <button class="btn details-btn">التفاصيل</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        @if ($posts->count()==0)
        <div class="alert alert-danger">لا يوجد مقالات </div>

       @endif
    </div>

</section>
@push('scripts')
<script>
    function toggleFavourite(heart) {
        var post_id = heart.id;

        $.ajax({
            url : '{{url(route('toggle-favourite'))}}',
            type: 'post',
            data: {_token:"{{csrf_token()}}",post_id:post_id},
            success: function (data) {

                if (data.state == 1)
                {
                    console.log(data);
                    var currentClass = $(heart).attr('class');
                    if (currentClass.includes('first')) {
                        $(heart).removeClass('first-heart').addClass('second-heart');
                    } else {
                        $(heart).removeClass('second-heart').addClass('first-heart');
                    }
                }
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
                alert(errorMessage);
            }
        });
    }
</script>
@endpush

@stop
