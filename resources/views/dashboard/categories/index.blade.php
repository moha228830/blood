@extends('layouts.dashboard.app')
@section('title')
@lang("site.categories")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.categories")
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

            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("site.new")</a>

    </div>


        <div class="box box-primary">



            <div class="box-header with-border">



                <form action="{{ route('categories.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4"  style="margin-top:5px ">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4" style="margin-top:5px ">
                            <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('site.search')</button>



                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->



            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table-hover  ">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.posts')</th>

                            <th class="">@lang('site.edit')</th>
                            <th class="">@lang('site.delete')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{$category->category}}</td>
                            <th>    <a href="" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i> @lang('site.posts')</a></th>


                                <td class="">

                                        <a href="{{url(route("categories.edit",$category->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                </td>
                                <td class="">
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
                </div>

                    {{ $categories->appends(request()->query())->links() }}
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
