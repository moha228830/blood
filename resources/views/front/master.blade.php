<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    </style>

    <title>بنك الدم الرئيسية </title>
</head>
<body>


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
                    <li class="d-inline-block mx-2"><a class="facebook" href=""><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="insta" href=""><i
                                class="fab fa-instagram"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="twitter" href=""><i
                                class="fab fa-twitter"></i></a></li>
                    <li class="d-inline-block mx-2"><a class="whatsapp" href=""><i
                                class="fab fa-whatsapp"></i></a></li>
                </ul>
            </div>
            @if(auth()->guard('clients')->user())
            <div class="connect">
                <div class="dropdown">
                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                       &nbsp; &nbsp;{{auth()->guard('clients')->user()->username}}
                    </a>
                    <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.html"> <i class="fas fa-home ml-2"></i>الرئيسيه</a>
                        <a class="dropdown-item" href="#"> <i class="fas fa-user-alt ml-2"></i>معلوماتى</a>
                        <a class="dropdown-item" href="#"> <i class="fas fa-bell ml-2"></i>اعدادات الاشعارات</a>
                        <a class="dropdown-item" href="#"> <i class="far fa-heart ml-2"></i>المفضلة</a>
                        <a class="dropdown-item" href="#"> <i class="far fa-comments ml-2"></i>ابلاغ</a>
                        <a class="dropdown-item" href="contact.html"> <i class="fas fa-phone ml-2"></i>تواصل
                            معنا</a>
                        <a class="dropdown-item" href="#"> <i class="fas fa-sign-out-alt ml-2"></i>خروج</a>
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
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">

                <a class="nav-link " href="{{url("home")}}#">الرئيسية </a>
                <span class="test"></span>


            </li>
            <li class="nav-item">
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
                    <a  href="{{url("home")}}#">
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

<script src="{{ asset('dashboard_files/js/select2.js') }}"></script>
<!-- Optional JavaScript -->
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
