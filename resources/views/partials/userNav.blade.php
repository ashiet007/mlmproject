<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3 font-weight-bold text-success" href="#"><i class="fas fa-portrait"></i> {{Auth::User()->name}}</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-success font-weight-bold" href="#"><i class="fa fa-user"></i> {{Auth::User()->user_name}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block btn btn-danger" style="border-radius: 6px; padding-top: 2px !important; padding-bottom: 2px !important;color: #fff;" href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {!! Form::token() !!}
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container" style="max-width: 100%">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a class="navbar-brand" href="{{route('user.index')}}"><img src="{{asset('images/logo3.png')}}" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center" style="padding-left: 0px;">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('user.index')}}">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="profiles" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Profiles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profiles">
                                <a class="dropdown-item" href="{{route('profile.viewProfile')}}">View Profile</a>
                                <a class="dropdown-item" href="{{route('profile.viewSponsor')}}">Sponsor Details</a>
                                <a class="dropdown-item" href="{{route('profile.viewSecurity')}}">Change Password</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="network" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Network
                            </a>
                            <div class="dropdown-menu" aria-labelledby="network">
                                <a class="dropdown-item" href="{{route('team.registeredList')}}">Direct Registered List</a>
                                <a class="dropdown-item" href="{{route('team.activeList')}}">Direct Active List</a>
                                <a class="dropdown-item" href="{{route('team.directList')}}">Total Direct List</a>
                                <a class="dropdown-item" href="{{route('team.rejectedList')}}">Direct Rejected List</a>
                                <a class="dropdown-item" href="{{route('team.totalTeam')}}">Total Team List</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="helpingReport" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Helping Report
                            </a>
                            <div class="dropdown-menu" aria-labelledby="helpingReport">
                                <a class="dropdown-item" href="{{route('report.provideHelpReport')}}">Given Help Report</a>
                                <a class="dropdown-item" href="{{route('report.receiveHelpReport')}}">Taken Help Report</a>
                                <a class="dropdown-item" href="{{route('report.rejectedHelpReport')}}">Rejected Help Report</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="poolWallet" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Pool Wallet
                            </a>
                            <div class="dropdown-menu" aria-labelledby="poolWallet">
                                <a class="dropdown-item" href="{{route('pool.index')}}">My Pools</a>
                                <a class="dropdown-item" href="{{route('pool.view')}}">View Company Pool</a>
                                <a class="dropdown-item" href="{{route('pool.transferForm')}}">Transfer to Fund Wallet</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="income" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Fund Wallet
                            </a>
                            <div class="dropdown-menu" aria-labelledby="income">
                                <a class="dropdown-item" href="{{route('income.direct')}}">Working Income</a>
                                <a class="dropdown-item" href="{{route('income.reports')}}">Transactions Report</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="epinWallet" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                E-Pin Wallet
                            </a>
                            <div class="dropdown-menu" aria-labelledby="epinWallet">
                                <a class="dropdown-item" href="{{route('epin.unused')}}">Unused Epin</a>
                                <a class="dropdown-item" href="{{route('epin.create')}}">Create Epin</a>
                                <a class="dropdown-item" href="{{route('epin.report')}}">Epin Reports</a>
                            </div>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="{{url('user/messages')}}">Message</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->