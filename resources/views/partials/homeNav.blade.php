<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" href="callto:+443003030266"><strong>CALL</strong> +44 300 303 0266</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-facebook"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-linkedin"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('/login')}}">login</a></li>
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{route('register')}}">register</a></li>
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