@extends('front.master')
@section('title')
طلب التبرع
@endsection
@section('content')
@php


$blood_types =  \DB::table("blood_types")->get();

$cities =  \DB::table("cities")->get();


    @endphp
<h2 class="donations-head horizntal-line">تفاصيل طلب التبرع </h2>

<!-- Donations offers  -->
<section id="donations">
    <div class="container custom-position">

        <div class="row  dropdown">






        </div>


        <div class="row background-div ">
            <div class="col-lg-2">
                <div class="blood-type border-circle">
                    <div class="blood-txt">
             {{$donation_reqs->blood_type}}
                    </div>

                </div>
            </div>
            <div class="col-lg-7">
                <ul class="order-details">
                    <div>
                    <li class="cutom-display custom-padding" >  الحالة :</li>
                    <span  class="cutom-display custom-padding ">    {{$donation_reqs->patient_name}}</span>
                    </div>


                    <div class="">
                        <li class="cutom-display custom-padding ">  عمر المريض  :</li>
                        <span class="cutom-display custom-padding ">{{$donation_reqs->age}}</span>
                    </div>


                    <div class="">
                        <li class="cutom-display custom-padding">  هاتف المريض  :</li>
                        <span class="cutom-display custom-padding">{{$donation_reqs->patient_phone}}</span>
                    </div>


                    <div class="">
                        <li class="cutom-display custom-padding "> المدينة :</li>
                        <span class="cutom-display custom-padding ">{{$donation_reqs->name}}</span>
                    </div>

                    <div>
                    <li class="cutom-display custom-padding"> مستشفي :</li>
                    <span class="cutom-display custom-padding">    {{$donation_reqs->hospital}}</span>
                    </div>



                    <div class="">
                        <li class="cutom-display custom-padding "> عنوان المستشفي :</li>
                        <span class="cutom-display custom-padding ">{{$donation_reqs->hospital_address}}</span>
                    </div>



                    <div class="">
                        <li class="cutom-display custom-padding "> عدد اكياس الدم :</li>
                        <span class="cutom-display custom-padding ">{{$donation_reqs->bags_num}}</span>
                    </div>




                    <div class="">
                        <li class="cutom-display custom-padding">   تاريخ الطلب  :</li>
                        <span class="cutom-display custom-padding">{{$donation_reqs->created_at}}</span>
                    </div>

                    <div class="">
                        <li class="cutom-display custom-padding">    التفاصيل    :</li>
                        <span class="cutom-display custom-padding">
                            @if($donation_reqs->details !="")
                            {{$donation_reqs->details}}</span>
                            @else
                          لا توجد بيانات</span>
                            @endif
                    </div>



                </ul>

            </div>

        </div>

        <div class="text-center" style="margin-top: 10px">
            <a href="{{url(route("front.donation"))}}">
                <button class="btn more3-btn">رجوع</button>
            </a>
        </div>
    </div>

</section>



@stop
