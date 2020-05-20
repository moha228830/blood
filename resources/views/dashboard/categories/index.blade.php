@extends('layouts.dashboard.app')

@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("الموضوعات")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$categories->count()}}</small>
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

            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('اضافة موضوع')</a>

    </div>


        <div class="box box-primary">


            <div class="box-body">



                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('الموضوع')</th>
                            <th>@lang('المقالات')</th>

                            <th class="text-center">@lang('ادارة')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{$category->category}}</td>
                            <th>    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i> @lang('المقالات')</a></th>


                                <td class="text-center">

                                        <a href="{{url(route("categories.edit",$category->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>


                                <form action="{{url(route("categories.destroy",$category->id)) }}" method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete  btn-sm"><i class="fa  fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->

                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table><!-- end of table -->



                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($categories)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
