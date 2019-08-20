<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" href="mailto:modinaamaindia@gmail.com"><strong>Mail us</strong> modinaamaindia@gmail.com</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-facebook"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        @guest
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block btn btn-success" style="border-radius: 6px; padding-top: 2px !important; padding-bottom: 2px !important;color: #fff;" href="{{url('/login')}}">login</a></li>
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block btn btn-danger" style="border-radius: 6px; padding-top: 2px !important; padding-bottom: 2px !important;color: #fff;" href="{{route('register')}}">register</a></li>
                        @else
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#">{{Auth::User()->name}}</a></li>
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{ url('/user/dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/logo3.png')}}" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('home.index')}}">Home</a>
                        </li>
                        <li class="nav-item @@about">
                            <a class="nav-link" href="{{route('home.about')}}">About</a>
                        </li>
                        <li class="nav-item @@courses">
                            <a class="nav-link" href="{{route('home.plan')}}">Plan(English)</a>
                        </li>
                        <li class="nav-item @@courses">
                            <a class="nav-link" href="{{route('home.planHindi')}}">Plan(Hindi)</a>
                        </li>
                        <li class="nav-item @@events">
                            <a class="nav-link" href="{{route('home.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->