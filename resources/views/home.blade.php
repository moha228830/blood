@extends('front.master')
@section('content')
    <!-- Header-->
    <header id="header">
        <div class="container-fluid">
            <div class="header-text">
                <h1 class="head-text">بنك الدم نمضى قدماً لصحة افضل</h1>
                <p class="follow-text"> تصل معنا الي الحالات
                    التي تحتاج نقل الدم <br>
                     او انشر طلبك للحصول علي
                   المساعدة</p>
                <a  href="{{url("home")}}#mobile-app">
                    <button class="btn login-btn">الي التطبيق</button>
                </a>
            </div>
        </div>
    </header>
    <section id="about">
        <div class="container-fluid">
            <p class="about-text">بنك الدم تطبيق يساعدك ويساعد المجتمع في الوصول لصحة افضل  تستطيع الوصول الي الحالات التي تحتاج المساعدة كما يمكنك من نشر طلبك اذا كنت تحتاج ال تحويل الدم بشكل اختياري يمكنك ادارة الاشعارات التي تصلك بالحالات التي تحتاج المساعدة حدد فصائل الدم والمحافظات التي تتلقي بها اشعارات

            </p>
        </div>
    </section>

    <!-- articles -->
    <section id="articles">
        <h2 class="donations-head horizntal-line"> المقالات </h2>
        <div class="container custom" style="direction: ltr">
            <div class="owl-carousel owl-theme" id="owl-articles">



                @foreach($posts as $post)

                    <div class="item">
                        <div class="card" style="width: 22rem;">
                            @if(auth()->guard('clients')->user())
                            <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="fab fa-gratipay


                                {{$post->is_favori ? 'second-heart' : 'first-heart'}}

                                "></i>
                                @endif                        <!---<i  class="fab fa-gratipay second-heart"></i>-->

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
            <center>
            <a href="{{url(route("client_posts"))}}" >
                <button class="btn more3-btn">المزيد</button>

            </a>
        </center>
        </div>

    </section>


    @php

$blood_types =  \DB::table("blood_types")->get();

$cities =  \DB::table("cities")->get();


    @endphp


    <section id="donations" style="margin-top: 20px">
        <h2 class="donations-head horizntal-line">طلبات التبرع </h2>
        <div class="container custom-position">
            <form action="{{url(route("home"))}}#donations" method="get">
                    <div class="row  dropdown" style="padding: 10px">

                        <div class="col-md-5" style="margin-top: 5px">
                            <select class="custom-select js-example-basic-single" name="blood">
                                <option value="" selected>اختر فصيلة الدم</option>
                                @foreach($blood_types as $blood_type)
                                <option
                                @if(request()->blood)
                                @if(request()->blood == $blood_type->id)
                                {{"selected"}}
                                @endif
                                @endif
                                value="{{$blood_type->id}}">{{$blood_type->blood_type}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-5" style="margin-top: 5px">
                            <select class="custom-select" name="city">
                                <option value="" selected>اختر المدينة</option>
                                @foreach($cities as $city)
                            <option
                            @if(request()->city)
                                @if(request()->city == $city->id)
                                {{"selected"}}
                                @endif
                                @endif
                            value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 " style="margin-top: 5px">
                            <button style="background: #fff"  type="submit" class="btn btn-defult btn-block"> @lang('site.search')</button>
                        </div>

                    </div>
                </form>
            @foreach($donation_reqs as $donation)
            <div class="row background-div ">
                <div class="col-lg-2">
                    <div class="blood-type border-circle">
                        <div class="blood-txt">
                 {{$donation->blood_type}}
                        </div>

                    </div>
                </div>
                <div class="col-lg-7">
                    <ul class="order-details">
                        <div>
                        <li class="cutom-display" >  الحالة:</li>
                        <span  class="cutom-display ">    {{$donation->patient_name}}</span>
                        </div>

                        <div>
                        <li class="cutom-display custom-padding"> مستشفي:</li>
                        <span class="cutom-display custom-padding">    {{$donation->hospital}}</span>
                        </div>

                        <div class="">
                            <li class="cutom-display "> المدينة:</li>
                            <span class="cutom-display ">{{$donation->name}}</span>
                        </div>


                    </ul>

                </div>
                <div class="col-lg-3">
                    <a href="{{url(route("front.donation.details",$donation->donation_id))}}">
                        <button class="btn more2-btn">التفاصيل</button>
                    </a>
                </div>

            </div>
            @endforeach
            <div class="text-center" style="margin-top: 10px">
            {{ $donation_reqs->appends(request()->query())->links() }}

            <a href="{{url(route("front.donation"))}}">
                <button class="btn more3-btn">المزيد</button>
            </a>
            </div>
        </div>

    </section>


    <section class="about-us my-4 py-5" id="about2">
        <div class="my-5 text-center"><img src={{asset('front/imgs/logo.png')}} alt="logo"></div>
        <div class="about-US-content px-4 mb-5">
            <p class="my-md-4"> بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق
                 بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى
            </p>
            <p class="my-md-4"> بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق لموقع
                بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى
            </p>
            <p class="my-md-4"> بنك الدم هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق
                بنك الدمهذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى
            </p>
        </div>
    </section><!--End about-us-->




    <!-- call us section  -->
    <section id="call-us">
        <h3 class="call-us-head">تواصل معنا</h3>
        <div class="row">
            <div class="col-lg-6">
        <P class="call-us-follow-text">يمكنكم الاتصال بنا للاستفسار عن المعلومات وسيتم التواصل معكم فوراً </P>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="whatsup">
                        <p id="number"> {{$setting->contact_phone}} 002+</p>
                        <img class="whats-logo" src="{{asset('front/imgs/whats.png')}}">


                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6 my-1">
        <div class="contact-form text-center">

            <form action="">

                <input type="text" name="messgAddres" class="form-control my-3" placeholder="عنوان الرسالة">
                <textarea name="messageText" class="form-control my-4" rows="5" placeholder="نص الرسالة"></textarea>
                <button  style="color: #fff" type="submit" class="btn login-btn shadow ">ارسال</button>
            </form>
        </div>
    </div>
</div>
    </section>

    <!-- mobile app   -->
    <section id="mobile-app" >
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <P class="app-head">تطبيق بنك الدم</P>
                    <P class="app-text">
                        نساعدك الي الارتقاء لصحة افضل وننمي روح العطاء لدي المجتمع حمل التطبيق وتابع معنا انت مصدر الحياة للمجتمع
                       </P>
                    <p class="availbale">متـــوفر علي </p>
                    <div class="stores">
                        <a href="{{$setting->android}}" target="_blank"><img src="{{asset('front/imgs/google.png')}}"></a>
                            <a href="{{$setting->ios}}" target="_blank"><img src="{{asset('front/imgs/ios.png')}}"></a>


                    </div>
                </div>
                <div class="col-md-6">
                    <img class="app image-responsive" src="{{asset('front/imgs/App.png')}}">
                </div>

            </div>

        </div>
    </section>

@stop

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
