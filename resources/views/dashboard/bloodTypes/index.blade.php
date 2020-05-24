@extends('layouts.dashboard.app')
@section('title')
@lang("site.bloodTypes")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.bloodTypes")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$bloodTypes->count()}}</small>
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

            <a href="{{ route('bloodTypes.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("site.new")</a>

    </div>


        <div class="box box-primary">



            <div class="box-header with-border">





            </div><!-- end of box header -->



            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">

                        <thead>
                        <tr>
                            <th >#</th>
                            <th class="text-center">@lang('site.bloodType')</th>


                            <th class="text-center">@lang('site.edit')</th>

                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($bloodTypes as $bloodType)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td class="text-center">{{$bloodType->blood_type}}</td>



                                <td class="text-center">

                                        <a href="{{url(route("bloodTypes.edit",$bloodType->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                </td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table><!-- end of table -->
                </div>


                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($bloodTypes)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
