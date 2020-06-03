@extends('layouts.dashboard.app')
@section('title',"الرئيسية")
@section('mo')
@include('flash::message')
@inject('governs', 'App\Models\Govern')
@inject('posts', 'App\Models\Post')
@inject('cities', 'App\Models\City')
@inject('categories', 'App\Models\Category')
@inject('clients', 'App\Models\client')
@inject('contacts', 'App\Models\ContactMesseg')
@inject('blood_types', 'App\Models\bloodType')
@inject('settings', 'App\Models\Setting')

@inject('donation_reqs', 'App\Models\DonationReq')
@inject('users', 'App\User')
@inject('roles', 'App\Role')


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
                      <span class="info-box-icon bg-aqua"><i class="fa fa-map-marker"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المحافظات</span>
                      <span class="info-box-number">{{$governs->count()}}<small></small></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="fa fa-flag"></i></span>
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
                      <span class="info-box-icon bg-yellow"><i class="fa fa-comment"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المقالات</span>
                        <span class="info-box-number">{{$posts->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-phone"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">تواصل معنا</span>
                        <span class="info-box-number">{{$contacts->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->



                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">العملاء</span>
                        <span class="info-box-number">{{$clients->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->



                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">فصائل الدم</span>
                        <span class="info-box-number">{{$blood_types->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->



                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-cogs"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">الاعدادات</span>
                        <span class="info-box-number">{{$settings->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-heart"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">طلبات التبرع</span>
                        <span class="info-box-number">{{$donation_reqs->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">المشرفين</span>
                        <span class="info-box-number">{{$users->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->


                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-list"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">رتب المشرفين</span>
                        <span class="info-box-number">{{$roles->count()}}</span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div><!-- /.col -->





                </div><!-- /.row -->
                <div class="row">


                    <div class="col-md-6">
                        <!-- LINE CHART -->
                        <div class="box box-info">
                          <div class="box-header with-border">
                            <h3 class="box-title">طلبات التبرع</h3>
                            <div class="box-tools pull-right">
                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                          <div class="box-body chart-responsive">
                            <div class="box-body border-radius-none">
                                <div class="chart" id="line-chart" style="height: 300px;"></div>
                            </div>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                       </div>

                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">التسجيل بالموقع</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body chart-responsive">
                        <div class="box-body border-radius-none">
                            <div class="chart" id="line-chart2" style="height: 300px;"></div>
                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                   </div>




                </div>

                <div class="row">
                   <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">المحافظات تبعا لعدد طلبات التبرع</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                         <div class="chart" id="bar-chart" style="height: 300px;"></div>
                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->



                  </div><!-- /.col (LEFT) -->


                  <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">المحافظات تبعا لعدد المسجلين بالموقع بالموقع</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                         <div class="chart" id="bar-chart2" style="height: 300px;"></div>
                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->



                  </div><!-- /.col (LEFT) -->
                </div>




            </div>
            </section>









        </div>






    </section><!-- /.content -->


@endsection
@push('scripts')

<script>

    //line chart
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            @foreach ($records as $record)
            {
                ym: "{{ $record->year }}-{{ $record->month }}", count: "{{ $record->count }}"
            },
            @endforeach
        ],
        xkey: 'ym',
        ykeys: ['count'],
        labels: ['@lang('طلبات التبرع')'],
        lineWidth: 2,
        hideHover: 'auto',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        gridTextFamily: 'Open Sans',
        gridTextSize: 10
    });



     //line chart
     var line = new Morris.Line({
        element: 'line-chart2',
        resize: true,
        data: [
            @foreach ($records_client as $record)
            {
                ym: "{{ $record->year }}-{{ $record->month }}", count: "{{ $record->count }}"
            },
            @endforeach
        ],
        xkey: 'ym',
        ykeys: ['count'],
        labels: ['@lang(' التسجيل بالموقع')'],
        lineWidth: 2,
        hideHover: 'auto',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        gridTextFamily: 'Open Sans',
        gridTextSize: 10
    });




/*
         * BAR CHART
         * ---------
         */

         var bar_data = {
          data: [
            @foreach ($govern_req as $record)
          ["{{$record->govern}}", {{$record->count}}],
          @endforeach

            ],
          color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"
            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
        /* END BAR CHART */




         var bar_data2 = {
          data: [
            @foreach ($govern_client as $record)
          ["{{$record->govern}}", {{$record->count}}],
          @endforeach

            ],
          color: "#3c8dbc"
        };
        $.plot("#bar-chart2", [bar_data2], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"
            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });



</script>

@endpush
