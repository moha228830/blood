@extends('front.master')
@section('title')
استعادة كلمة المرور
@endsection
@section('content')
<div class="container" style="margin: 20px auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('استعادة كلمة المرور') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('pin_code')}}">
                        @csrf



                        <div class="form-group row">
                            <label for="pin_code" class="col-md-4 col-form-label text-md-right">{{ __('كود التحقق') }}</label>

                            <div class="col-md-6">
                                <input id="pin_code" type="number" class="form-control @error('pin_code') is-invalid @enderror" name="pin_code" value="{{ $email ?? old('pin_code') }}" required  autofocus>

                                @error('pin_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور الجديدة') }}</label>

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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
@endsection
