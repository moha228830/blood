@extends('layouts.dashboard.app')
@section('title')
تعديل محافظة
@endsection
@section('mo')

<!-- include('flash::message') -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
     تعديل محافظة :

      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">



            </div><!-- end of box header -->
            <div class="box-body">

               @include('partials._errors')


                  {!! Form::model($govern, ['route' => ['governs.update',$govern->id],
                  "method"=>"PUT"

                  ])!!}
                    {{ csrf_field() }}



                        <div class="form-group">
                            <label>@lang('اسم المحافظة')</label>
                          {!!  Form::text('name',$govern->name,[
                        "class"=>"form-control"

                          ])!!}
                        </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('تعديل')</button>
                    </div>

                    {!! Form::close() !!}

            </div><!-- end of box body -->

        </div><!-- end of box -->





        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
