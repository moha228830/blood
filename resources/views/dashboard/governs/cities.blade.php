@extends('layouts.dashboard.app')
@section('title')
عرض المدن
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
          محافظة
     {{$govern->name }}
      <small style="padding: 2px;background:rgb(180, 164, 164)"></small>
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



        <div class="box box-primary">


            <div class="box-body">



                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('المدينة')</th>

                        </tr>
                        </thead>

                        <tbody>

                            @foreach ($govern->cities as $city)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{$city->name}}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table><!-- end of table -->



                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($govern->cities)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif



        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
