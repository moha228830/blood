@extends('layouts.dashboard.app')
@section('title')
تعديل مدينة
@endsection
@section('mo')

<!-- include('flash::message') -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
     تعديل المدينة :

      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">



            </div><!-- end of box header -->
            <div class="box-body">

               @include('partials._errors')


                  {!! Form::model($city, ['route' => ['cities.update',$city->id],
                  "method"=>"PUT"

                  ])!!}
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label>@lang(' المحافظة')</label>
                    <select style="width: 100%" class="js-example-basic-single form-control" name="govern_id">
                        <option value=""></option>
                       @foreach ($governs as $gov)
                    <option
                    @if ($gov->id == $city->govern_id)
                      {{"selected"}}
                    @endif
                    value="{{$gov->id}}">{{$gov->name}}</option>

                       @endforeach
                      </select>
                    </div>

                        <div class="form-group">
                            <label>@lang('اسم المدينة')</label>
                          {!!  Form::text('name',$city->name,[
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
