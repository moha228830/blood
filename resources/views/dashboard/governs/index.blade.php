@extends('layouts.dashboard.app')
@section('title')
@lang("المحافظات")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">


    <h1>
     @lang("المحافظات")
    <small style="padding: 2px;background:rgb(180, 164, 164)">{{$governs->count()}}</small>
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

          <a href="{{url(route("governs.create")) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("site.new")</a>

  </div>


      <div class="box box-primary">



          <div class="box-header with-border">





                  <form action="{{ route('governs.index') }}" method="get">

                      <div class="row">

                          <div class="col-md-4"  style="margin-top:5px ">
                              {!! Form::text('keyword',request('keyword'),[
                                  'class' => 'form-control',
                                  'placeholder' => '    بحث باسم المحافظة  '
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

                            <th class="text-center">@lang('المحافظة')</th>
                            <th class="text-center">@lang('المدن')</th>

                            <th class="text-center">@lang('تعديل')</th>
                            <th class="text-center">@lang('حذف')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($governs as $govern)


                          <tr>
                                <td>{{$loop->iteration}}</td>
                            <td  class="text-center">{{$govern->name}}</td>
                            <td class="text-center">  <a href="{{url(route("governs.show",$govern->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> @lang('عرض المدن')</a></td>


                                <td class="text-center">

                                        <a href="{{url(route("governs.edit",$govern->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                    </td>
                                <td  class="text-center">
                                <form action="{{url(route("governs.destroy",$govern->id)) }}" method="post" style="display: inline-block">
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
            @if(count($governs)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
