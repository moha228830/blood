@extends('front.master')
@section('content')

    <!-- breedcrumb-->
    <section id="breedcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url(route("home"))}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل دخول</li>
                        </ol>
                    </nav>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 signup-form">
                    <form class="needs-validation" novalidate method="post" action="{{url(route('client_login_submit'))}}">
                        <div class="form-row">

                         @csrf

                        <input value="{{old("email")}}" name="email" type="email" class="form-control" id="validationCustom02"
                                   placeholder="البريد الاكتروني"
                                   required>

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-row">





                            <input name="password" type="password" class="form-control" id="validationCustom05" placeholder=" كلمة المرور"
                            required>
                     <div class="invalid-feedback">
                         Please provide a valid password .
                     </div>








                            </div>
                        </div>
                        <button class="btn btn-create shadow" type="submit">دخول</button>
                    </form>

                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (function () {
                            'use strict';
                            window.addEventListener('load', function () {
                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                var forms = document.getElementsByClassName('needs-validation');
                                // Loop over them and prevent submission
                                var validation = Array.prototype.filter.call(forms, function (form) {
                                    form.addEventListener('submit', function (event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                    </script>

                </div>

            </div>
        </div>
    </section>

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
@stop
