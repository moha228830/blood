@extends('front.master')
@section('title')
المقالات المفضلة
@endsection
@section('content')

@php
$cats =  \DB::table("categories")->get();

 @endphp

   <!-- articles -->
   <section id="articles" style="margin-bottom: 20px">
    <h2 class="donations-head horizntal-line"  style="padding:5px">  المقالات المفضلة </h2>
    <div style="margin-bottom: 30px ;padding:10px">
        <form action="{{url(route("client_posts"))}}" method="get">
            <div class="row  dropdown" style="padding-top: 10px">

                <div class="col-md-5" style="margin-top: 5px">
                    <select class="custom-select js-example-basic-single" name="cat">
                        <option value="" selected>اختر  الموضوع</option>
                        @foreach($cats as $cat)
                        <option
                        @if(request()->cat)
                          @if(request()->cat == $cat->id)
                          {{"selected"}}
                          @endif
                          @endif
                        value="{{$cat->id}}">{{$cat->category}}</option>
                            @endforeach
                    </select>
                </div>


                <div class="col-md-2 " style="margin-top: 5px">
                    <button style="background: #fff"  type="submit" class="btn btn-defult btn-block"> @lang('site.search')</button>
                </div>

            </div>
        </form>
    </div>
    <div class="container custom" style="direction: ltr">
        <div class="owl-carousel owl-theme" id="owl-articles">



            @foreach($posts as $post)

                <div class="item">
                    <div class="card" style="width: 22rem;">
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
        <div class="alert alert-danger">لا يوجد مقالات مفضلة لديك</div>
        @endif

        {{ $posts->appends(request()->query())->links() }}
    </div>

</section>
<div class="container">
<div style="margin-bottom: 20px">
{{ $posts->appends(request()->query())->links() }}
</div>
</div>
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
