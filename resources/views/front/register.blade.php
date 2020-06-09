@extends('front.master')
@section('title')
تسجيل جديد
@endsection
@section('content')
<div class="container" style="margin: 20px auto">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('تسجيل جديد') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sine_up_submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('رقم الهاتف') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="name" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تاكيد كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ الميلاد') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="name" autofocus>

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ  اخر تبرع') }}</label>

                            <div class="col-md-6">
                                <input id="last_donation" type="date" class="form-control @error('last_donation') is-invalid @enderror" name="last_donation" value="{{ old('last_donation') }}" required autocomplete="name" autofocus>

                                @error('last_donation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block text-center " style="width: 80%;margin:0 auto">
                                    {{ __('تسجيل') }}
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
