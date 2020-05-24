@extends('layouts.dashboard.app')
@section('title')
@lang("site.users")
@endsection
@section('mo')
@include('flash::message')
@inject("role","App\Role")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.users")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$users->count()}}</small>
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

            <a href="{{url(route("users.create")) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang("site.new")</a>

    </div>


        <div class="box box-primary">



            <div class="box-header with-border">





                    <form action="{{ route('users.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4"  style="margin-top:5px ">
                                {!! Form::text('keyword',request('keyword'),[
                                    'class' => 'form-control',
                                    'placeholder' => '      بحث بالاسم او البريد الاكتروني'
                                ]) !!}
                            </div>


                            <div class="col-sm-4" style="margin-top: 5px">
                                {!! Form::select('blood_type_id',$role->pluck('display_name','id')->toArray(),request('role_id'),[
                                        'class' => 'form-control',
                                        'placeholder' =>'  بحث  بالرتبة'
                                    ]) !!}
                            </div>

                            <div class="col-md-4" style="margin-top:5px ">
                                <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> @lang('site.search')</button>



                            </div>

                        </div>
                    </form><!-- end of form -->


            </div><!-- end of box header -->



            <div class="box-body">


                <div class="table-responsive">
                    <table class="data-table table table-bordered">
                        <thead>
                        <th>#</th>
                        <th class="text-center">اسم المستخدم</th>
                        <th class="text-center">الايميل</th>
                        <th class="text-center">الرتبة</th>
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr >
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">
                                    @foreach($user->roles as $role)
                                        <span class="label label-success">{{$role->display_name}}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{url(route("users.edit",$user->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{url(route("users.destroy",$user->id)) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete  btn-sm"><i class="fa  fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->

                                    </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                    {{ $users->appends(request()->query())->links() }}
                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($users)==0)
            <div class="alert alert-danger"> لا يوجد بيانات
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
