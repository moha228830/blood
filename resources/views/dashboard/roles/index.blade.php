@extends('layouts.dashboard.app')
@section('title')
@lang("الرتب")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("رتب المستخدمين")
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
    <div class="  " style="padding:10px">

        <a href="{{url(route('roles.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> أضف رتبة</a>

    </div>


        <div class="box box-primary">



            <div class="box-header with-border">





            </div><!-- end of box header -->



            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th> الاسم المعروض</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->display_name}}</td>
                                <td class="text-center">
                                    <a href="{{url(route("roles.edit",$record->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{url(route("roles.destroy",$record->id)) }}" method="post" style="display: inline-block">
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


                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($records)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
