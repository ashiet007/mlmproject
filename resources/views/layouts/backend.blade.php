<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Modinaama India</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="_token" content="{{csrf_token()}}">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{asset('plugins/slick/slick.css')}}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{asset('plugins/themify-icons/themify-icons.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('plugins/animate/animate.css')}}">
    <!-- aos -->
    <link rel="stylesheet" href="{{asset('plugins/aos/aos.css')}}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{asset('plugins/venobox/venobox.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <!-- Main Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('styles')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <style>
        .nav-item
        {
            margin: 0 10px;
        }
    </style>

</head>

<body>
@if(Auth::user()->hasRole('Admin'))
    @if(Request()->route()->getPrefix() == '/admin')
        @include('partials.adminNav')
    @elseif(Auth::user()->hasRole('User') && Request()->route()->getPrefix() == '/user')
        @include('partials.userNav')
    @endif
@elseif(Auth::user()->hasRole('User'))
    @include('partials.userNav')
@endif
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->
@if ($errors->any())
    <div class="container alert notification-error mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@yield('content')

<!-- footer -->
<footer>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-sm-left text-center">
                    <p class="mb-0">Copyright
                        <script>
                            var CurrentYear = new Date().getFullYear()
                            document.write(CurrentYear)
                        </script>
                        © <a href="{{url('/')}}">Modinaama</a></p> . All Rights Reserved.
                </div>
                <div class="col-sm-5 text-sm-right text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.facebook.com/themefisher"><i class="ti-facebook text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.twitter.com/themefisher"><i class="ti-twitter-alt text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-instagram text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="https://dribbble.com/themefisher"><i class="ti-dribbble text-primary"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- slick slider -->
<script src="{{asset('plugins/slick/slick.min.js')}}"></script>
<!-- aos -->
<script src="{{asset('plugins/aos/aos.js')}}"></script>
<!-- venobox popup -->
<script src="{{asset('plugins/venobox/venobox.min.js')}}"></script>
<!-- mixitup filter -->
<script src="{{asset('plugins/mixitup/mixitup.min.js')}}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="{{asset('plugins/google-map/gmap.js')}}"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('.table').DataTable({
            "lengthMenu": [100,50,25,10]
        });
    } );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script>
    new ClipboardJS('.btn-clip');
</script>
@include('sweet::alert')

<!-- Main Script -->
<script src="{{asset('js/script.js')}}"></script>
@yield('scripts')
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>