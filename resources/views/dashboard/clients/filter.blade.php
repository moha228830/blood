@extends('layouts.dashboard.app')
@section('title')
@lang("site.clients")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.clients")

      <small style="padding: 5px;background:rgb(196, 148, 148);color:#000">  العدد الكلي للفلترة : {{$clients->count()}}</small>
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



    </div>


        <div class="box box-primary">



            <div class="box-header with-border">





                    <form action="{{ route('clients.filter') }}" method="get">

                        <div class="row">

                            <div class="col-md-12"  style="margin-top:5px ">
                                <label>@lang(' تاريخ التسجيل من :')</label>
                                {!! Form::date('from',request('from'),[
                                    'class' => 'form-control',

                                ]) !!}
                            </div>

                            <div class="col-md-12"  style="margin-top:5px ">
                                <label>@lang(' تاريخ التسجيل الي :')</label>
                                {!! Form::date('to',request('to'),[
                                    'class' => 'form-control',

                                ]) !!}
                            </div>






                        </div>
             <br>
                        <div class="row">



                            @inject('bloodType','App\Models\BloodType')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('blood_type_id',$bloodType->pluck('blood_type','id')->toArray(),request('blood_type_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'   فصيلة الدم'
                                    ]) !!}
                            </div>

                            @inject('city','App\Models\City')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('city_id',$city->pluck('name','id')->toArray(),request('city_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'    المدينة'
                                    ]) !!}
                            </div>

                            @inject('govern','App\Models\Govern')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('govern_id',$govern->pluck('name','id')->toArray(),request('overn_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'  المحافظة'
                                    ]) !!}
                            </div>

                            <div class="col-md-3" style="margin-top:5px ">
                                <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('site.search')</button>



                            </div>

                        </div>
                    </form><!-- end of form -->


            </div><!-- end of box header -->

            <br>
            <div class="box-header with-border" style="background: #000">

            </div>
            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">@lang('site.username')</th>
                            <th class="text-center">@lang('site.email')</th>
                            <th class="text-center"> @lang('site.date_of_birth')</th>
                            <th class="text-center">@lang('site.phone')</th>
                            <th class="text-center"> @lang('site.bloodType')</th>
                            <th class="text-center">  @lang('site.last_donationt') </th>
                            <th class="text-center">@lang('site.city')</th>
                            <th class="text-center">@lang('site.govern')</th>
                            <th class="text-center"> @lang('site.register_date')</th>
                            <th class="text-center"> @lang('site.activity') </th>
                            <th class="text-center">@lang('site.delete')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr id="removable{{$client->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$client->username}}</td>
                                <td class="text-center">{{$client->email}}</td>
                                <td class="text-center">{{$client->date_of_birth}}</td>
                                <td class="text-center">{{$client->phone}}</td>
                                <td class="text-center">{{$client->blood_type->blood_type}}</td>
                                <td class="text-center">{{$client->last_donation}}</td>
                                <td class="text-center">{{$client->city->name}}</td>
                                <td class="text-center">{{$client->city->govern->name}}</td>
                                <td class="text-center">{{$client->date}}</td>
                                <td class="text-center">
                            @if($client->activity == 1)
                             <a href="{{url(route("clients.Inactive",$client->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-check"></i> @lang('site.active')</a>
                            @endif
                            @if($client->activity == 0)
                             <a href="{{url(route("clients.active",$client->id)) }}" class="btn btn-danger btn-sm"><i class="fa fa-"></i> @lang('site.Inactive')</a>
                            @endif


                            </td>
                                <td class="text-center">
                                    <form action="{{url(route("clients.active",$client->id)) }}" method="post" style="display: inline-block">
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

                    {{ $clients->appends(request()->query())->links() }}
                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($clients)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
