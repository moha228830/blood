@extends('front.master')
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


                <div class="text-center" style="margin-top: 10px">
                    <a href="{{url(route("client_posts"))}}">
                        <button class="btn more3-btn">المقالات</button>
                    </a>
                </div>


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
