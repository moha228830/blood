@extends('layouts.dashboard.app')
@section('title')
@lang("site.donationReqs")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.donationReqs")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$donationReqs->count()}}</small>
      </h1>
       <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="  " style="padding:10px">

            <a href="{{ route('donationReqs.filter') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("فلترة")</a>

    </div>


        <div class="box box-primary">



            <div class="box-header with-border">





                    <form action="{{ route('donationReqs.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4"  style="margin-top:5px ">
                                {!! Form::text('keyword',request('keyword'),[
                                    'class' => 'form-control',
                                    'placeholder' => 'المريض او العميل او الهاتف او المدينة'
                                ]) !!}
                            </div>

                            @inject('bloodType','App\Models\BloodType')
                            <div class="col-sm-4" style="margin-top: 5px">
                                {!! Form::select('blood_type_id',$bloodType->pluck('blood_type','id')->toArray(),request('blood_type_id'),[
                                        'class' => 'form-control',
                                        'placeholder' =>'  بحث بفصيلة الدم'
                                    ]) !!}
                            </div>

                            <div class="col-md-4" style="margin-top:5px ">
                                <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('site.search')</button>



                            </div>

                        </div>
                    </form><!-- end of form -->


            </div><!-- end of box header -->



            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">@lang('site.patient_name')</th>
                            <th class="text-center">@lang('site.phone')</th>
                            <th class="text-center"> @lang('site.city')</th>
                            <th class="text-center">@lang('site.bloodType')</th>
                            <th class="text-center">  @lang('site.hospital_name') </th>
                            <th class="text-center">@lang('site.age')</th>
                            <th class="text-center">@lang('site.hospital_address')</th>
                            <th class="text-center"> @lang('site.bags_num')</th>
                            <th class="text-center"> @lang('site.date')</th>
                            <th class="text-center"> @lang('site.donationReq') </th>
                            <th class="text-center">@lang('site.delete')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($donationReqs as $donationReq)
                            <tr id="removable{{$donationReq->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$donationReq->patient_name}}</td>
                                <td class="text-center">{{$donationReq->patient_phone}}</td>
                                <td class="text-center">{{$donationReq->city->name}}</td>
                                <td class="text-center">{{$donationReq->blood_type->blood_type}}</td>
                                <td class="text-center">{{$donationReq->hospital_name}}</td>
                                <td class="text-center">{{$donationReq->age}}</td>
                                <td class="text-center">{{$donationReq->hospital_address}}</td>
                                <td class="text-center">{{$donationReq->bags_num}}</td>
                                <td class="text-center">{{$donationReq->date}}</td>
                                <td class="text-center">{{$donationReq->client->username}}</td>

                                <td class="text-center">
                                    <form action="{{url(route("donationReqs.destroy",$donationReq->id)) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete  btn-sm"><i class="fa  fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->

                                    </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                    {{ $donationReqs->appends(request()->query())->links() }}
                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($donationReqs)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
