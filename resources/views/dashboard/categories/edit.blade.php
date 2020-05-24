@extends('layouts.dashboard.app')
@section('title')
@lang("site.edit_cat")
@endsection
@section('mo')

<!-- include('flash::message') -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
        @lang("site.edit_cat")

      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">



            </div><!-- end of box header -->
            <div class="box-body">

               @include('partials._errors')


                  {!! Form::model($category, ['route' => ['categories.update',$category->id],
                  "method"=>"PUT"

                  ])!!}
                    {{ csrf_field() }}



                        <div class="form-group">
                            <label>@lang('site.category')</label>
                          {!!  Form::text('category',$category->name,[
                        "class"=>"form-control"

                          ])!!}
                        </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                    </div>

                    {!! Form::close() !!}

            </div><!-- end of box body -->

        </div><!-- end of box -->





        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
