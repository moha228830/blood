@extends('front.master')

@section('content')
<div class="container" style="margin: 20px auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card " >
                <div style="background: #0069D9;color:#fff" class="card-header">{{ __('اعدادات الاشعارات') }}</div>

                <div class="card-body">
                    @inject('governs', 'App\Models\govern')
                    {!! Form::model(null, ['route' => ["notificationSetting"],
                    "method"=>"post"

                    ])!!}

                    <div class="form-group">
                        <label for="governs">المحافظات</label>
                        {!! Form::select('governs[]',$governs->pluck('name','id')->toArray(),null,[
                        'class' => 'form-control js-example-basic-single',
                        'multiple' => 'multiple',
                        "style"=>"width:100%"
                     ]) !!}
                    </div>
             <br>
                    @inject('bloodTypes', 'App\Models\bloodType')
                    <div class="form-group">
                        <label for="blood_types">فصائل الدم</label>
                        {!! Form::select('blood_types[]',$bloodTypes->pluck('blood_type','id')->toArray(),null,[
                        'class' => 'form-control js-example-basic-single',
                        'multiple' => 'multiple',
                        "style"=>"width:100%"
                     ]) !!}
                    </div>

                    <br>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-12">
                            <button type="submit" class="btn btn-primary btn-block text-center " style="width: 100%;margin:0 auto">
                                {{ __('حفظ') }}
                            </button>
                        </div>
                    </div>



                   {!! Form::close () !!}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
