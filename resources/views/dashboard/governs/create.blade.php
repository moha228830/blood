@extends('layouts.dashboard.app')
@section('title')
اضافة محافظة
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
اضافة محافظة :
      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">

            </div><!-- end of box header -->
            <div class="box-body">

               @include('partials._errors')


                  {!! Form::model("", ['route' => ['governs.store'],
                  "method"=>"post"

                  ])!!}
                    {{ csrf_field() }}



                        <div class="form-group">
                            <label>@lang('اسم المحافظة')</label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>

                    {!! Form::close() !!}

            </div><!-- end of box body -->

        </div><!-- end of box -->





        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
