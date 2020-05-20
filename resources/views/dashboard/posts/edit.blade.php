@extends('layouts.dashboard.app')

@section('mo')

<!-- include('flash::message') -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
     تعديل المقال :

      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">



            </div><!-- end of box header -->

            <div class="row">
                <div class="col-md-8">
            <div class="box-body">

               @include('partials._errors')


                  {!! Form::model($post, ['route' => ['posts.update',$post->id],
                  "method"=>"PUT", 'enctype' => 'multipart/form-data'

                  ])!!}
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label style="display: block">@lang(' الموضوع')</label>
                    <select style="width: 100%" class="js-example-basic-single form-control" name="category_id">
                        <option value=""></option>
                       @foreach ($categories as $cat)
                    <option
                    @if ($cat->id == $post->category_id)
                      {{"selected"}}
                    @endif
                    value="{{$cat->id}}">{{$cat->category}}</option>

                       @endforeach
                      </select>
                    </div>

                        <div class="form-group">
                            <label>@lang(' عنوان المقال')</label>
                          {!!  Form::text('title',$post->title,[
                        "class"=>"form-control"

                          ])!!}
                        </div>


                        <div class="form-group">
                            <label>@lang(' محتوي المقال')</label>
                            <textarea type="text" name="content" class="form-control" rows="10">
                              {{$post->content}}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>@lang('  ارفاق صورة')</label>
                            <input type="file" name="img" class="form-control" value="">
                        </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('تعديل')</button>
                    </div>

                    {!! Form::close() !!}

            </div><!-- end of box body -->
        </div>
        <div class="col-md-4">
        <img style="width: 300px; height:400px" src="{{asset($post->img)}}">

        </div>
    </div>

        </div><!-- end of box -->





        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
