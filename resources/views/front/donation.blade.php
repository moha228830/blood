@extends('front.master')
@section('title')
طلبات التبرع
@endsection
@section('content')
@php


$blood_types =  \DB::table("blood_types")->get();

$cities =  \DB::table("cities")->get();


    @endphp

<h2 class="donations-head horizntal-line" style="padding: 5px">طلبات التبرع </h2>

<!-- Donations offers  -->
<section id="donations">
    <div class="container custom-position">
        <form action="{{url(route("front.donation"))}}" method="get">
        <div class="row  dropdown" style="padding: 10px">

            <div class="col-md-4" style="margin-top: 5px">
                <select class="custom-select js-example-basic-single" name="blood" tyle="width: 100%">
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

            <div class="col-md-4" style="margin-top: 5px">
                <select class="custom-select js-example-basic-single" name="city" style="width: 100%">
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
            <div class="col-md-2 " style="margin-top: 5px;padding:0">
                <button style="background: #fff;padding:2px"  type="submit" class="btn btn-defult btn-block"> @lang('site.search')</button>
            </div>
            <div class="col-md-2 " style="margin-top: 5px ;padding:0">
               <a href="{{url(route("add_donation"))}}"> <span style="padding:2px"  type="submit" class=" btn-block"> طلب تبرع جديد</span>
               </a>
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
        </div>
    </div>

</section>



@stop
