@extends('layouts.dashboard.app')
@section('title')
@lang("site.contacts")
@endsection
@section('mo')
@include('flash::message')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


      <h1>
       @lang("site.contacts")
      <small style="padding: 2px;background:rgb(180, 164, 164)">{{$contacts->count()}}</small>
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



                <form action="{{ route('contacts.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4"  style="margin-top:5px ">
                            {!! Form::text('keyword',request('keyword'),[
                                'class' => 'form-control',
                                'placeholder' => 'بحث بالاسم ورقم الهاتف والايميل'
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
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">@lang("site.title")</th>
                            <th class="text-center">@lang("site.msg")</th>
                            <th class="text-center"> @lang("site.username")</th>
                            <th class="text-center">  @lang("site.email")</th>
                            <th class="text-center">  @lang("site.phone")</th>

                            <th class="text-center">@lang("site.delete")</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr id="removable{{$contact->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center">{{$contact->title}}</td>
                                <td class="text-center">{{$contact->content}}</td>
                                <td class="text-center">{{$contact->client->username}}</td>
                                <td class="text-center">{{$contact->client->email}}</td>
                                <td class="text-center">{{$contact->client->phone}}</td>

                                <td class="text-center">
                                    <form action="{{url(route("contacts.destroy",$contact->id)) }}" method="post" style="display: inline-block">
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

                    {{ $contacts->appends(request()->query())->links() }}
                    <!-- Button trigger modal -->


            </div><!-- end of box body -->

            @if(count($contacts)==0)
            <div class="alert alert-danger">@lang('site.no_data')
            </div>
             @endif




        </div>






    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

@endsection
