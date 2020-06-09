@extends('front.master')
@section('title')
الاشعارات
@endsection
@section('content')
<div class="container" style="margin: 20px auto;background:#F8F9FA">
    <div class="card " style="overflow: auto">
        <div style="background: #0069D9;color:#fff" class="card-header">{{ __(' اشعارات التبرع الخاصة بك') }}</div>

        <div class="card-body">
    <div class="row justify-content-center">

  @foreach ($all as $item)


        <div class="col-md-12">
            <div class="row background-div ">

                <div class="col-lg-7" style="padding: 0">
                    <ul class="" >
                        <div>

                        <span  class="cutom-display ">   {{$item->created_at}}</span>
                        </div>

                        <div>

                        <span class="cutom-display custom-padding">   {{$item->content}}</span>
                        </div>




                    </ul>

                </div>
                <div class="col-lg-3">
                    <a href="{{url(route("front.donation.details",$item->donation_req_id))}}">
                        <button class="btn btn-primary">التفاصيل</button>
                    </a>
                </div>

            </div>
            </div>
            <hr style="color:#000">
            @endforeach
        </div>

    </div>

</div>
</div>
</div>
@endsection
