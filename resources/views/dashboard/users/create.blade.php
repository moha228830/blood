@extends('layouts.dashboard.app')
@section('title')
@lang("اضافة مشرف")
@endsection
@section('mo')
@include('flash::message')
@inject('role','App\Role')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
اضافة مشرف :
      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">

            </div><!-- end of box header -->
            <div class="box-body">




               {!! Form::model($model, ['route' => ['users.store'],
               "method"=>"post"

               ])!!}




<?php
$roles = $role->pluck('display_name', 'id')->toArray();
?>

<div class="form-group">
    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="email">الايميل</label>
    {!! Form::text('email',null,[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="password">كلمة المرور</label>
    {!! Form::password('password',[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">تأكيد كلمة المرور</label>
    {!! Form::password('password_confirmation',[
    'class' => 'form-control'
 ]) !!}
</div>
<div class="form-group">
    <label for="roles_list">رتب المستخدمين</label>
    {!! Form::select('roles_list[]',$roles,null,[
    'class' => 'form-control js-example-basic-single',
    'multiple' => 'multiple',
 ]) !!}
</div>

<div class="form-group">
 <button class="btn btn-primary" type="submit"> حفظ</button>
</div>







             {!! Form::close () !!}

            </div><!-- end of box body -->

        </div><!-- end of box -->












    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
