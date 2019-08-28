<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" href="#"><i class="fas fa-portrait"></i> {{Auth::User()->name}}</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="fa fa-user"></i> {{Auth::User()->user_name}}</a></li>
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
                <a class="navbar-brand" href="{{route('admin.dashboard')}}"><img src="{{asset('images/logo3.png')}}" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/admin/users') }}">Users</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="actions" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Admin Action
                            </a>
                            <div class="dropdown-menu" aria-labelledby="actions">
                                <a class="dropdown-item" href="{{ url('/admin/news') }}">Publish News</a>
                                <a class="dropdown-item" href="{{ route('user.createUserForm') }}">Create Fake User</a>
                                <a class="dropdown-item" href="{{ route('action.index') }}">Block/Unblock User</a>
                                <a class="dropdown-item" href="{{ route('action.linkAction') }}">Total Link ON/OFF</a>
                                <a class="dropdown-item" href="{{ route('user.viewSecurity') }}">Change Password</a>
                                <a class="dropdown-item" href="{{ url('admin/contact') }}">Contact</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="downline" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Downline
                            </a>
                            <div class="dropdown-menu" aria-labelledby="downline">
                                <a class="dropdown-item" href="{{ route('downline.directTeam') }}">Total Direct Team</a>
                                <a class="dropdown-item" href="{{ route('downline.totalDownline') }}">Total Downline</a>
                                <a class="dropdown-item" href="{{ route('downline.rejectedMembers') }}">Total Rejected</a>
                                <a class="dropdown-item" href="{{ route('downline.blockedMembers') }}">Total Blocked</a>
                                <a class="dropdown-item" href="{{ route('downline.neglectedMembers') }}">Total Neglected</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="joiningReport" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Joining Report
                            </a>
                            <div class="dropdown-menu" aria-labelledby="joiningReport">
                                <a class="dropdown-item" href="{{ route('joining.index')}}">Date-wise joining</a>
                                <a class="dropdown-item" href="{{ route('joining.newJoining') }}">Total New Joining</a>
                                <a class="dropdown-item" href="{{ route('joining.registeredList') }}">Total Registered List</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="linkReport" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Link Report
                            </a>
                            <div class="dropdown-menu" aria-labelledby="linkReport">
                                <a class="dropdown-item" href="{{ route('linkReport.accptedLink') }}">Accepted Link</a>
                                <a class="dropdown-item" href="{{ route('linkReport.rejectedLink') }}">Rejected Link</a>
                                <a class="dropdown-item" href="{{ route('linkReport.pendingLink') }}">Pending Link</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="storedLink" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Stored Link
                            </a>
                            <div class="dropdown-menu" aria-labelledby="storedLink">
                                <a class="dropdown-item" href="{{ route('linkReport.sendersList') }}">Senders List</a>
                                <a class="dropdown-item" href="{{ route('linkReport.receiverList') }}">Receivers List</a>
                                <a class="dropdown-item" href="{{ url('/admin/give-helps') }}">Give Helps</a>
                                <a class="dropdown-item" href="{{ url('/admin/get-helps') }}">Get Help helping</a>
                                <a class="dropdown-item" href="{{ url('/admin/get-helps-working') }}">Get Help Working</a>
                                <a class="dropdown-item" href="{{ route('linkReport.receiverFundList') }}">Receiver Funds List</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="fundManagement" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Fund Management
                            </a>
                            <div class="dropdown-menu" aria-labelledby="fundManagement">
                                <a class="dropdown-item" href="{{ route('fund.addFundForm') }}">Add Fund</a>
                                <a class="dropdown-item" href="{{ route('fund.fundList') }}">Added Fund History</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="epin" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Epin Wallet
                            </a>
                            <div class="dropdown-menu" aria-labelledby="epin">
                                <a class="dropdown-item" href="{{ route('adminEpin.create') }}">Create E-Pin</a>
                                <a class="dropdown-item" href="{{ route('adminEpin.unused') }}">Transfer Epin</a>
                                <a class="dropdown-item" href="{{ route('adminEpin.report') }}">Epin Reports</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="pool" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Pool Wallet
                            </a>
                            <div class="dropdown-menu" style="left: -100;" aria-labelledby="pool">
                                <a class="dropdown-item" href="{{route('adminPool.view')}}">Current Pool View</a>
                                <a class="dropdown-item" href="{{route('adminPool.viewList')}}">Current Pool History</a>
                                <a class="dropdown-item" href="{{route('adminPool.pendingPoolReport')}}">Pending Pool History</a>
                                <a class="dropdown-item" href="{{route('adminPool.poolActionReport')}}">Pool Action History</a>
                                <a class="dropdown-item" href="{{route('adminPool.pooledOutUsers')}}">Pooled Out History</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->
