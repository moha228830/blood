@extends('layouts.dashboard.app')
@section('title')
@lang("site.settings")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.settings")

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



        <div class="box box-primary">



            <div class="box-header with-border">





            </div><!-- end of box header -->



            <div class="box-body">

             @if ($setting)


                    <?php
                    $id = $setting->id;
                    $about_app = $setting->about_app;
                    $text= $setting->setting_notification_text;
                    $tw_link= $setting->tw_link	;
                    $fb_link= $setting->fb_link;
                    $contact_email= $setting->contact_email;
                    $contact_phone= $setting->contact_phone	;
                    $insta_link=$setting->insta_link	;
                    $yt_link=$setting->yt_link	;
                     ?>

             @else

                    <?php
                     $id = "";
                    $about_app = "";
                    $text= "";
                    $tw_link= ""	;
                    $fb_link= "";
                    $contact_email= "";
                    $contact_phone= ""	;
                    $insta_link="";
                    $yt_link="";
                      ?>

             @endif
                {!! Form::model($setting, ['route' => ['settings.update',$id],
                "method"=>"post"

                ])!!}
                  {{ csrf_field() }}



                      <div class="form-group">
                          <label>@lang('site.tw_link')</label>
                        {!!  Form::text('tw_link',$tw_link,[
                      "class"=>"form-control"

                        ])!!}
                      </div>

                      <div class="form-group">
                        <label>@lang('site.fb_link')</label>
                      {!!  Form::text('fb_link',$fb_link,[
                    "class"=>"form-control"

                      ])!!}
                    </div>

                      <div class="form-group">
                        <label>@lang('site.yt_link')</label>
                      {!!  Form::text('yt_link',$yt_link,[
                    "class"=>"form-control"

                      ])!!}
                    </div>


                    <div class="form-group">
                        <label>@lang('site.insta_link')</label>
                      {!!  Form::text('insta_link',$insta_link,[
                    "class"=>"form-control"

                      ])!!}
                    </div>

                    <div class="form-group">
                        <label>@lang('site.contact_phone')</label>
                      {!!  Form::text('contact_phone',$contact_phone,[
                    "class"=>"form-control"

                      ])!!}
                    </div>

                    <div class="form-group">
                        <label>@lang('site.contact_email')</label>
                      {!!  Form::text('contact_email',$contact_email,[
                    "class"=>"form-control"

                      ])!!}
                    </div>


                      <div class="form-group">
                        <label>@lang('site.about_app')</label>
                        <textarea type="text" name="about_app" class="form-control" rows="5">
                            {{$about_app}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.text')</label>
                        <textarea  name="setting_notification_text" class="form-control" rows="5">
                            {{$text}}
                        </textarea>
                    </div>


                  <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.save')</button>
                  </div>

                  {!! Form::close() !!}



                    <!-- Button trigger modal -->


            </div><!-- end of box body -->






        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
