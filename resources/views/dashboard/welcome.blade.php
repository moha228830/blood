@extends('layouts.dashboard.app')
@section('title',"الرئيسية")
@section('mo')
@include('flash::message')
@inject('governs', 'App\Models\Govern')
@inject('posts', 'App\Models\Post')
@inject('cities', 'App\Models\City')
@inject('categories', 'App\Models\Category')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("الرئيسية")
        <small>لوحة التحكم</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">





        <div class="box box-primary">





            <section class="content" style="background: #ECF0F5">
                <!-- Info boxes -->
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-flag"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المحافظات</span>
                      <span class="info-box-number">{{$governs->count()}}<small></small></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المدن</span>
                        <span class="info-box-number">{{$cities->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix visible-sm-block"></div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-bars"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">الموضوعات</span>
                        <span class="info-box-number">{{$categories->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المقالات</span>
                        <span class="info-box-number">{{$posts->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->
                </div><!-- /.row -->


                </div>
            </section>











        </div>






    </section><!-- /.content -->


@endsection
