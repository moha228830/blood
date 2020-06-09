@extends('front.master')
@section('title')
اضافة طلب تبرع
@endsection@section('content')
<div class="container" style="margin: 20px auto">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __(' اضافة طلب تبرع') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save_donation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 col-form-label text-md-right">{{ __('اسم المريص') }}</label>

                            <div class="col-md-6">
                                <input id="patient_name" type="text" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" value="{{ old('patient_name') }}" required autocomplete="patient_name" autofocus>

                                @error('patient_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('عمر المريص') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="patient_phone" class="col-md-4 col-form-label text-md-right">{{ __('رقم الهاتف') }}</label>

                            <div class="col-md-6">
                                <input id="patient_phone" type="number" class="form-control @error('patient_phone') is-invalid @enderror" name="patient_phone" value="{{ old('patient_phone') }}" required autocomplete="patient_phone" autofocus>

                                @error('patient_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hospital_name" class="col-md-4 col-form-label text-md-right">{{ __('المستشفي ') }}</label>

                            <div class="col-md-6">
                                <input id="hospital_name" type="text" class="form-control @error('hospital_name') is-invalid @enderror" name="hospital_name" value="{{ old('hospital_name') }}" required autocomplete="hospital_name">

                                @error('hospital_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hospital_address" class="col-md-4 col-form-label text-md-right">{{ __(' عنوان المستشفي') }}</label>

                            <div class="col-md-6">
                                <input id="hospital_address" type="text" class="form-control @error('hospital_address') is-invalid @enderror" name="hospital_address" value="{{ old('hospital_address') }}" required autocomplete="hospital_address">

                                @error('hospital_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bags_num" class="col-md-4 col-form-label text-md-right">{{ __('  عدد اكياس الدم') }}</label>

                            <div class="col-md-6">
                                <input id="bags_num" type="number" class="form-control @error('bags_num') is-invalid @enderror" name="bags_num" required autocomplete="bags_num" value="{{ old('bags_num') }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="blood" class="col-md-4 col-form-label text-md-right">{{ __('فصيلة الدم') }}</label>

                            <div class="col-md-6">
                                @inject('blood_types','App\Models\BloodType')
                                {!! Form::select('blood_type_id',$blood_types->pluck('blood_type','id')->toArray(),null,[
                                  'class' => 'form-control form-control-lg' . ($errors->has('blood') ? ' is-invalid' : null),
                                    'id' => 'blood',
                                    'placeholder' => 'اختر فصيلة الدم',
                                    "required"=>"required",



                                ])

                                !!}

                                @error('blood_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="govern" class="col-md-4 col-form-label text-md-right">{{ __(' المحافظة') }}</label>

                            <div class="col-md-6">
                                @inject('governs','App\Models\govern')
                            {!! Form::select('govern_id',$governs->pluck('name','id')->toArray(),null,[
                               'class' => 'form-control form-control-lg' . ($errors->has('governs') ? ' is-invalid' : null),
                                'id' => 'govern',
                                'placeholder' => 'اختر محافظة',
                                "required"=>"required"

                            ]) !!}

                                @error('governs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="cities" class="col-md-4 col-form-label text-md-right">{{ __(' المدينة') }}</label>

                            <div class="col-md-6">

                                {!! Form::select('city_id',[],null,[
                                   'class' => 'form-control form-control-lg' . ($errors->has('city_id') ? ' is-invalid' : null),
                                    'id' => 'cities',
                                    'placeholder' => 'اختر مدينة',
                                    "required"=>"required"
                                ]) !!}

                                @error('governs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label text-md-right"><small>اختياري</small>{{ __(' التفاصيل ') }} </label>

                            <div class="col-md-6">
                                <textarea id="details" rows="5" class="form-control @error('details') is-invalid @enderror" name="details"  required autocomplete="details" autofocus>
                                {{ old('details') }}
                                </textarea>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block text-center " style="width: 80%;margin:0 auto">
                                    {{ __('حفظ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $("#govern").change(function (e) {
        e.preventDefault();
        // get gov
        // send ajax
        // append cities

        var govern = $("#govern").val();
        if (govern)
        {
            $.ajax({
                url : '{{url('api/v1/cities')}}',
                type: 'post',
                data: {_token:"{{csrf_token()}}",govern_id:govern},
                success: function (data) {

                    if (data.state == 1)
                    {

                        $("#cities").empty();
                        $("#cities").append('<option value="">اختر مدينة</option>');
                        $.each(data.data, function (index, city) {
                            $("#cities").append('<option value="'+city.id+'">'+city.name+'</option>');
                        });
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    alert(errorMessage);
                }
            });
        }else{
            $("#cities").empty();
            $("#cities").append('<option value="">اختر مدينة</option>');
        }
    });
</script>
@endpush
@endsection
