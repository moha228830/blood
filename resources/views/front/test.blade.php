@extends('front.master')
@section('title')
test_code
@endsection
@section('content')
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                <div class="card">


                        <div class="card-header">Send push to Users</div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                <form action="{{ route('send-push') }}" method="post">
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" value="{{$user->id}}" />

                                                    <input class="btn btn-primary" type="submit" value="Send Push">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-header">User Panel</div>

                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        $(document).ready(function(){
            const config = {
                apiKey: "AIzaSyDo7ROTfCj3FUEdnIRe1t_1vqDcNiN0giY",
                authDomain: "moha-15237.firebaseapp.com",
                databaseURL: "https://moha-15237.firebaseio.com",
                projectId: "moha-15237",
               storageBucket: "moha-15237.appspot.com",
               messagingSenderId: "895678542983",
                appId: "1:895678542983:web:3cabd0402e892222683422"

            };

            firebase.initializeApp(config);
            const messaging = firebase.messaging();


            messaging.requestPermission()
                .then(function () {
                    return messaging.getToken()
                })


                .then(function(token) {


                   console.log(token)
                })
                .catch(function (err) {

                    console.log("Unable to get permission to notify.", err);
                });

                messaging.onMessage(function(payload) {
                console.log(payload)
                });
        });
    </script>
    @endpush
@endsection
