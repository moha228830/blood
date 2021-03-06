<!doctype html>
<html lang="en" style="overflow:auto">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- custom CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <link rel=stylesheet href="{{asset('front/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- custom font -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/select2.css') }}">
    <link rel="manifest" href="{{ asset('front/js/manifest.json') }}">
    <style>
@media (max-width:768px){
    .cont{
        display: none;
    }
    .slick-caption {
        right:15%;
        left: 15%;
        top: 10%;
        text-align: center;
    }
}
.connect{
    font-weight: 500;
}
.connect .dropdown{
    cursor: pointer;
    direction: rtl;
    padding: 0px;
    margin: 0px
}
.connect .dropdown span{
    color: #D0934D;
}
.connect .dropdown-item{
    padding: 0.75rem .4rem;
    direction: rtl
}
.connect .dropdown-item:not(:last-child) {
   border-bottom: 1px solid #ddd;
}
.connect .dropdown-item:hover{
    background: #2D3E50;
    color: #fff;
}
.connect .dropdown-item i{
    color: #dedfe1;
}
.form-control{
    padding: 0px
}
#not{
    background-color: #ffc107;display: inline;
                       padding: .2em .3em .3em;
                       font-size: 75%;
                       font-weight: 700;
                       line-height: 1;
                       color: #fff;
                       text-align: center;
                       white-space: nowrap;
                       vertical-align: baseline;
                       border-radius: .25em;position: absolute;
                       top:-2px;
                        right: -11px;
                        font-size: 72%;}
    </style>

    <title>  @yield('title') </title>
</head>
<body style="overflow: hidden">


  <!--top-bar-->
  <div class="top-bar py-2" style="background: #2d3e50;
  color: #fff;padding-bottom: .5rem!important;padding-top: .5rem!important;">
    <div class="container">
        <!--row of top-bar-->
        <div class="d-flex justify-content-between" style="display: -webkit-box!important;
        display: flex!important;">
            <div>
                |
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a style= rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
                |
                @endforeach

            </div>
            <div class="con">
                <ul class="list-unstyled" >
                    <li class="d-inline-block mx-2"><a class="facebook" href="{{$setting->fb_link}}"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="insta" href="{{$setting->insta_link}}"><i
                                class="fab fa-instagram"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="twitter" href="{{$setting->tw_link}}"><i
                                class="fab fa-twitter"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$setting->wats_link}}"><i
                                class="fab fa-whatsapp"></i></a></li>
                </ul>
            </div>
            @if(auth()->guard('clients')->user())
            <div class="connect">
                <div class="dropdown" >



                    <a style="background:#000" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
@inject('ClientNotification', 'App\Models\ClientNotification')

@php
 $id=auth()->guard('clients')->user()->id;
$is_read=$ClientNotification->where("client_id",$id)->where("is_read","0")->get();
@endphp
                        @if($is_read->count() !=0)
                       <span id="not" class="label label-warning" style=""> {{$is_read->count()}}</span>
                         @endif
                       <i class="fas fa-user ml-2"></i>


                    </a>
                    <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">

                      <center>
                          <a class="dropdown-item" href="{{url(route("notification_client"))}}">  <i class="fas fa-bell ml-2"></i> اشعارات طلبات التبرع
                        @if($is_read->count() !=0)
                        <span style="color: red">  (  {{$is_read->count()}} )</span>
                        @endif
                        </a>
                     </center>

                        <center> <a class="dropdown-item" href="{{url(route("notification_setting"))}}">  <i class="fa fa-cogs ml-2"></i> اعدادات الاشعارات</a> </center>

                            <center> <a class="dropdown-item" href="{{url(route("client_profile"))}}"> <i class="fas fa-user-alt ml-2"></i> معلوماتى</a> </center>

                                <center><a class="dropdown-item" href="{{url(route("favorite"))}}"> <i class="far fa-heart ml-2"> </i> المفضلة</a> </center>
                                    <center> <a class="dropdown-item" href="{{url(route("add_donation"))}}"> <i class="fa fa-list ml-2"></i> اضافة طلب تبرع</a> </center>


                            <center><a class="dropdown-item" href="{{url(route("client_logout"))}}"> <i class="fas fa-sign-out-alt ml-2"> </i> خروج</a> </center>

                    </div>
                </div>
                @endif
            </div>
        </div>
        <!--End row-->
    </div>
    <!--End container-->
</div>
<!--End top-bar-->
<!-- oradaniry nav section -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="nav-logo " href="{{url("home")}}#"><img class="logo" src={{asset('front/imgs/logo.png')}}></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText" style="padding: 5px">
        <ul class="navbar-nav mr-auto" >
            <li class="nav-item active">

                <a class="nav-link " href="{{url("home")}}">الرئيسية </a>
                <span class="test"></span>


            </li>
            <li class="nav-item" >
                <a class="nav-link border-left" href="{{url("home")}}#about">عن بنك الدم </a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url("client_posts")}}">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href={{url("home/donation")}}>طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url("home")}}#about2">من نحن</a>

            </li>
            <li class="nav-item">
            <a class="nav-link border-left" href="{{url("home")}}#call-us">تواصل معنا </a>
            </li>
            @if(auth()->guard('web')->user())
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route("dashboard.index"))}}"> لوحة التحكم </a>
                </li>
            @else
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route("dashboard.index"))}}">  ادارة </a>
                </li>
            @endif
             {{--<!-- Tasks: style can be found in dropdown.less -->--}}

        </ul>
        <span class="navbar-text">

            @if(!auth()->guard('clients')->user())
        <a class="new-account" href="{{url(route("sine_up"))}}" style="margin-bottom: 5px">انشاء حــساب جديد</a>
           <a href="{{url(route("client_login"))}}"><button class="btn login-btn shadow">دخول</button></a>
           @else
           <a href="{{url(route("client_logout"))}}"><button class="btn login-btn shadow">تسجيل خروج</button></a>
           @endif
          </span>
    </div>
</nav>


{{--  Start Content --}}
@yield('content')
{{-- End Content --}}

<!--  FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="footer-logo" src="{{asset('front/imgs/logo.png')}}">
                <p class="footer-text">بنك الدم تطبيق يساعدك ويساعد المجتمع في الوصول لصحة افضل  تستطيع الوصول الي الحالات التي تحتاج المساعدة كما يمكنك من نشر طلبك اذا كنت تحتاج ال تحويل الدم بشكل اختياري يمكنك ادارة الاشعارات التي تصلك بالحالات التي تحتاج المساعدة حدد فصائل الدم والمحافظات التي تتلقي بها اشعارات</p>
            </div>
            <div class="col-md-4">
                <ul class="footer-list">
                    <a  href="{{url("home")}}">
                        <li> الرئيسيه</li>
                    </a>
                    <a  href="{{url("home")}}#about">
                        <li> عن بنك الدم</li>
                    </a>
                    <a  href="{{url("client_posts")}}">
                        <li> المقالات</li>
                    </a>
                    <a href={{url("home/donation")}}>
                        <li> طلبات التبرع</li>
                    </a>
                    <a href="{{url("home")}}#about2">
                        <li> من نحن</li>
                    </a>
                    <a href="{{url("home")}}#call-us">
                        <li>  تواصل معنا</li>
                    </a>

                </ul>
            </div>
            <div class="col-md-4 change-position">
                <p class="footer-subtext">مـتــوفر علي </p>
                <a href="{{$setting->android}}" target="_blank"><img class="footer-android" src="{{asset('front/imgs/google1.png')}}"></a>
                    <a href="{{$setting->ios}}" target="_blank"><img class="footer-ios" src="{{asset('front/imgs/ios1.png')}}"></a>

            </div>

        </div>
    </div>

</footer>
<section id="last-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="social-media">
                    <a href="{{$setting->fb_link}}" target="_blank"><i class="fab fa-facebook-f hvr-float"></i></a>
                    <a href="{{$setting->insta_link}}" target="_blank"><i class="fab fa-instagram hvr-float"></i></a>
                    <a href="{{$setting->tw_link}}" target="_blank"><i class="fab fa-twitter hvr-float"></i></a>
                    <a href="{{$setting->wats_link}}" target="_blank"><i class="fab fa-whatsapp hvr-float"></i></a>

                </div>

            </div>
            <div class="col-md-8">
                <p class="copys"> جميع الحقوق محفوظ ل <span id="website-name"> بنك الدم وابداع تك </span> &copy;2019
                </p>

            </div>

        </div>
        <p class="myname">Made with <i class="fas fa-heart"></i> by Mazen Anwar</p>
    </div>


</section>

<!-- loader  -->
<section class="overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</section>


<!-- Optional JavaScript
<script src="front/js/firbase.js"></script>
-->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="{{ asset('dashboard_files/js/select2.js') }}"></script>
<script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('{{asset('front/js/firebase-messaging-sw.js')}}');
      });
    }
  </script>
<script type="text/javascript">var scrolltotop = {
        setting: {
            startline: 100,
            scrollto: 0,
            scrollduration: 1e3,
            fadeduration: [500, 100]
        },
        controlHTML: '<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow92.png" />',
        controlattrs: {offsetx: 5, offsety: 5},
        anchorkeyword: "#top",
        state: {isvisible: !1, shouldvisible: !1},
        scrollup: function () {
            this.cssfixedsupport || this.$control.css({opacity: 0});
            var t = isNaN(this.setting.scrollto) ? this.setting.scrollto : parseInt(this.setting.scrollto);
            t = "string" == typeof t && 1 == jQuery("#" + t).length ? jQuery("#" + t).offset().top : 0, this.$body.animate({scrollTop: t}, this.setting.scrollduration)
        },
        keepfixed: function () {
            var t = jQuery(window), o = t.scrollLeft() + t.width() - this.$control.width() - this.controlattrs.offsetx,
                s = t.scrollTop() + t.height() - this.$control.height() - this.controlattrs.offsety;
            this.$control.css({left: o + "px", top: s + "px"})
        },
        togglecontrol: function () {
            var t = jQuery(window).scrollTop();
            this.cssfixedsupport || this.keepfixed(), this.state.shouldvisible = t >= this.setting.startline ? !0 : !1, this.state.shouldvisible && !this.state.isvisible ? (this.$control.stop().animate({opacity: 1}, this.setting.fadeduration[0]), this.state.isvisible = !0) : 0 == this.state.shouldvisible && this.state.isvisible && (this.$control.stop().animate({opacity: 0}, this.setting.fadeduration[1]), this.state.isvisible = !1)
        },
        init: function () {
            jQuery(document).ready(function (t) {
                var o = scrolltotop, s = document.all;
                o.cssfixedsupport = !s || s && "CSS1Compat" == document.compatMode && window.XMLHttpRequest, o.$body = t(window.opera ? "CSS1Compat" == document.compatMode ? "html" : "body" : "html,body"), o.$control = t('<div id="topcontrol">' + o.controlHTML + "</div>").css({
                    position: o.cssfixedsupport ? "fixed" : "absolute",
                    bottom: o.controlattrs.offsety,
                    right: o.controlattrs.offsetx,
                    opacity: 0,
                    cursor: "pointer"
                }).attr({title: "Scroll to Top"}).click(function () {
                    return o.scrollup(), !1
                }).appendTo("body"), document.all && !window.XMLHttpRequest && "" != o.$control.text() && o.$control.css({width: o.$control.width()}), o.togglecontrol(), t('a[href="' + o.anchorkeyword + '"]').click(function () {
                    return o.scrollup(), !1
                }), t(window).bind("scroll resize", function (t) {
                    o.togglecontrol()
                })
            })
        }
    };
    scrolltotop.init();


    </script>

<script>
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
@stack('scripts')
@include('sweetalert::alert')
</body>
</html>

<script>
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
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
       messaging.usePublicVapidKey("BF2lDTgqhjcDt5aPbdEg0iS7jgycknTTsn7BbPtJ23lQtScRDJBy7Fw9y9wyPVBKppSguc85SxFcf3f1sowiOx4");


            messaging.requestPermission()
                .then(function () {
                  console.log("success connection")
                 // if(isTokenSentToServer()){
                    // console.log("token allredy send")
                 // }else{
                     getRegisterToken()
                 // }


                })



                .catch(function (err) {

                    console.log("Unable to get permission to notify.", err);
                });

              function getRegisterToken(){

                   // Get Instance ID token. Initially this makes a network call, once retrieved
                            // subsequent calls to getToken will return from cache.
                            messaging.getToken().then((currentToken) => {
                              if (currentToken) {
                                console.log(currentToken);
                                saveToken(currentToken);
                                sendTokenToServer(currentToken);
                                //updateUIForPushEnabled(currentToken);
                              } else {
                                // Show permission request.
                                console.log('No Instance ID token available. Request permission to generate one.');
                                // Show permission UI.
                                //updateUIForPushPermissionRequired();
                                setTokenSentToServer(false);
                              }
                            }).catch((err) => {
                             // console.log('An error occurred while retrieving token. ', err);
                              //showToken('Error retrieving Instance ID token. ', err);
                              setTokenSentToServer(false);
                            });

               }
               function setTokenSentToServer(sent) {
                 window.localStorage.setItem('sentToServer', sent ? '1' : '0');
                 }

                 function isTokenSentToServer() {
                        return window.localStorage.getItem('sentToServer') === '1';
                        }


                 function sendTokenToServer(currentToken) {
                     if (!isTokenSentToServer()) {
                    console.log('Sending token to server...');
                   // TODO(developer): Send the current token to your server.
                   setTokenSentToServer(true);
                   } else {
                     console.log('Token already sent to server so won\'t send it again ' +
                     'unless it changes');
    }

  }


 function saveToken(currentToken){


        $.ajax({
           url: '{{url(route('save-device-token'))}}',
           type: 'POST',

           data: {_token:"{{csrf_token()}}",
           Client_id:"{{auth()->guard('clients')->user()->id ?? ""}}",
           token: currentToken

        },
           success: function (response) {
           console.log(response)
           },
           error: function (err) {
            console.log(err);
           },
       });
    }

    messaging.onMessage(function(payload) {
        console.log(payload);

       //console.log(payload.notification.title);
       var not = document.querySelectorAll("#not");
       document.getElementById("not").innerHTML= parseInt(not[0].textContent) + 1;
       document.getElementById("te").innerHTML="لديك طلب تبرع جديد";

     var title = payload.notification.title;
     var option={
         body:payload.notification.body
     };
        var notification = new Notification(title,option);
    });
   })
</script>
