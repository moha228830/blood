@extends('layouts.dashboard.app')

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

            <a href="{{ route('governs.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('اضافة محافظة')</a>

    </div>


        <div class="box box-primary">


            <div class="box-body">



                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('المحافظة')</th>
                            <th>@lang('المدن')</th>

                            <th class="text-center">@lang('ادارة')</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($governs as $govern)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{$govern->name}}</td>
                            <th>           <a href="{{url(route("governs.show",$govern->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> @lang('عرض المدن')</a></th>


                                <td class="text-center">

                                        <a href="{{url(route("governs.edit",$govern->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>


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
