@extends('layouts.dashboard.app')

@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("المدن")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$cities->count()}}</small>
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

            <a href="{{ route('cities.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('اضافة مدينة')</a>

    </div>


        <div class="box box-primary">


            <div class="box-body">



                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('المدينة')</th>
                            <th>@lang('المحافظة')</th>
                            <th class="text-center">@lang('ادارة')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($cities as $city)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{$city->name}}</td>
                            <td>{{$city->govern->name}}</td>


                                <td class="text-center">

                                        <a href="{{url(route("cities.edit",$city->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>


                                <form action="{{url(route("cities.destroy",$city->id)) }}" method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete  btn-sm"><i class="fa  fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->

                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table><!-- end of table -->





            </div><!-- end of box body -->

            @if(count($cities)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>





    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
