@extends('layouts.dashboard.app')

@section('mo')
@include('flash::message')
@inject('model','App\Role')
@inject('perm','App\Permission')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h3>
 تعديل الرتبة :
      </h3>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">




            <div class="box-header">

            </div><!-- end of box header -->
            <div class="box-body">




               {!! Form::model($record, ['route' => ['roles.update',$record->id],
               "method"=>"put"

               ])!!}



<div class="form-group">
 <label for="name">الاسم</label>
 {!! Form::text('name',null,[
 'class' => 'form-control'
]) !!}
</div>
<div class="form-group">
 <label for="display_name">الاسم المعروض</label>
 {!! Form::text('display_name',null,[
 'class' => 'form-control'
]) !!}
</div>
<div class="form-group">
 <label for="description">الوصف</label>
 {!! Form::textarea('description',null,[
 'class' => 'form-control'
]) !!}
</div>
<div class="form-group">
 <label for="name">الصلاحيات</label><br>
 <input id="select-all" type="checkbox">  <label for='select-all'>  اختيار الكل  </label>
 <br>
 <div class="row">
     @foreach($perm->all() as $permission)
         <div class="col-sm-3">
             <div class="checkbox">
                 <label>
                     <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"
                     @if($record->hasPermission($permission->name))
                         checked
                     @endif
                     >
                     {{$permission->display_name}}
                 </label>
             </div>
         </div>
     @endforeach
 </div>
</div>
<div class="form-group">
 <button class="btn btn-primary" type="submit"> حفظ</button>
</div>


@push('scripts')
 <script>
     $("#select-all").click(function(){
         $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
     });

 </script>
@endpush




             {!! Form::close () !!}

            </div><!-- end of box body -->

        </div><!-- end of box -->





        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
