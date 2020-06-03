@extends('layouts.dashboard.app')
@section('title')
@lang("المقالات")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">


    <h1>
     @lang("المقالات")
    <small style="padding: 2px;background:rgb(180, 164, 164)">{{$posts->count()}}</small>
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

          <a href="{{url(route("posts.create")) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("site.new")</a>

  </div>


      <div class="box box-primary">



          <div class="box-header with-border">





                  <form action="{{ route('posts.index') }}" method="get">

                      <div class="row">

                          <div class="col-md-4"  style="margin-top:5px ">
                              {!! Form::text('keyword',request('keyword'),[
                                  'class' => 'form-control',
                                  'placeholder' => '    بحث  بعنوان المقال  '
                              ]) !!}
                          </div>



                          <div class="col-md-4" style="margin-top:5px ">
                              <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('site.search')</button>



                          </div>

                      </div>
                  </form><!-- end of form -->


          </div><!-- end of box header -->



          <div class="box-body">



                    <table class="table table-hover table table-bordered">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">@lang('العنوان ')</th>
                            <th class="text-center">@lang('الموضوع')</th>
                            <th class="text-center">@lang('عرض')</th>
                            <th class="text-center">@lang('تعديل')</th>
                            <th class="text-center">@lang('حذف')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td class="text-center">{{$post->title}}</td>
                            <td class="text-center">{{$post->category->category}}</td>

                              <td class="text-center"><a href="{{url(route('client_post',$post->id))}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> @lang('عرض')</a></td>
                                <td class="text-center">

                                        <a href="{{url(route("posts.edit",$post->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    </td>
                                        <td class="text-center">
                                <form action="{{url(route("posts.destroy",$post->id)) }}" method="post" style="display: inline-block">
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

            @if(count($posts)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif



        </div>





    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
