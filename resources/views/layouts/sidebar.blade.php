<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from kanakku.dreamguystech.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Nov 2021 18:06:17 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Amali</title>

    <link rel="shortcut icon" href="{{asset('assets/img/lg.png')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

<!--[if lt IE 9]>
    <script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/respond.min.js')}}"></script>
    <![endif]-->

    @yield('styles')
</head>
<body>

<div class="main-wrapper">

    <div class="header">

        <div class="header-left">
            <a href="{{url('dashboard')}}" class="logo">
                <img src="{{asset('assets/img/lg.png')}}" alt="Logo">
            </a>
            <a href="{{url('dashboard')}}" class="logo logo-small">
                <img src="{{asset('assets/img/lg.png')}}" alt="Logo" width="30" height="30">
            </a>
        </div>


        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>

        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>


        <ul class="nav nav-tabs user-menu">


            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i data-feather="bell"></i> <span class="badge rounded-pill">0</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All</a>
                    </div>
                </div>


            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<span class="user-img">
<img src="{{asset('assets/img/profiles/avatar-01.jpg')}}" alt="">
<span class="status online"></span>
</span>
                    <span>{{\Illuminate\Support\Facades\Auth::user()->firstname}}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('profile')}}"><i data-feather="user" class="me-1"></i>
                        Profile</a>
                    <a class="dropdown-item" href="{{route('settings')}}"><i data-feather="settings" class="me-1"></i>
                        Settings</a>
                    <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="log-out" class="me-1"></i>
                        Logout</a>
                </div>
            </li>

        </ul>

    </div>


    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"><span>Main</span></li>

                    @if(canSee('dashboard'))
                        <li>
                            <a class="nav-link" href="{{route('dashboard')}}"><i class="fa fa-home"></i>
                                <span>Dashboard</span></a>
                        </li>
                    @endif

                    @if(canSee('agents'))
                        <li>
                            <a class="nav-link" href="{{route('agents')}}"><i class="fa fa-user-friends"></i>
                                <span>Agents</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('float')}}"><i class="fa fa-gift"></i>
                                <span>Request Float</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('floatloan')}}"><i class="fa fa-percent"></i>
                                <span>My Loan</span></a>
                        </li>
                    @endif

                    @if(canSee('customers'))
                        <li>
                            <a class="nav-link" href="{{route('customers')}}"><i class="fa fa-users"></i>
                                <span>Customers</span></a>
                        </li>
                    @endif

                    @if(canSee('debit-card'))
                        <li>
                            <a class="nav-link" href="{{route('debit-card')}}"><i class="fa fa-credit-card"></i>
                                <span>Debit Card</span></a>
                        </li>
                    @endif

                    {{--                    <li>--}}
                    {{--                        <a class="nav-link active" href="{{url('posmanagement')}}"><i class="fa fa-terminal"></i>--}}
                    {{--                            <span>Posmanagement</span></a>--}}
                    {{--                    </li>--}}

{{--                    @if(canSee('Transfer'))--}}
                        <li>
                            <a class="nav-link active" href="{{route('transfer')}}"><i
                                    class="fa fa-credit-card"></i>
                                <span>Transfer</span></a>
                        </li>
{{--                    @endif--}}

                    @if(canSee('buy-airtime'))
                        <li>
                            <a class="nav-link active" href="{{route('bills.airtime')}}"><i
                                    class="fa fa-network-wired"></i>
                                <span>Buy Airtime</span></a>
                        </li>
                    @endif


                    @if(canSee('buy-data'))
                        <li>
                            <a class="nav-link active" href="{{route('bills.data')}}"><i
                                    class="fa fa-network-wired"></i>
                                <span>Buy Data</span></a>
                        </li>
                    @endif


                    @if(canSee('pay-bills'))
                        <li>
                            <a class="nav-link active" href="{{url('bill-payment')}}"><i class="fa fa-sticky-note"></i>
                                <span>Pay Bills</span></a>
                        </li>
                    @endif

                    @if(canSee('performance'))
                        <li>
                            <a href="{{route('agent.performance')}}"><i class="fa fa-chart-bar"></i>
                                <span>Performance</span></a>
                        </li>
                    @endif

                    @if(canSee('terminals'))
                        <li>
                            <a href="{{route('terminals')}}"><i class="fa fa-mobile"></i> <span>Terminals</span></a>
                        </li>
                    @endif

                    @if(canSee('wallet-history'))
                        <li>
                            <a href="{{route('walletHistory')}}"><i class="fa fa-retweet"></i>
                                <span>Wallet History</span></a>
                        </li>
                    @endif

                    @if(canSee('transactions'))
                        <li>
                            <a href="{{route('transactions')}}"><i class="fa fa-retweet"></i>
                                <span>Transactions</span></a>
                        </li>
                    @endif

                    @if(canSee('wallet-withdraw'))
                        <li>
                            <a href="{{route('walletWithdraw')}}"><i class="fa fa-arrow-alt-circle-right"></i>
                                <span>Withdraw</span></a>
                        </li>
                    @endif

                    @if(canSee('wallet-transfer'))
                        <li>
                            <a href="{{route('walletTransfer')}}"><i class="fa fa-arrow-alt-circle-right"></i>
                                <span>Wallet Transfer</span></a>
                        </li>
                    @endif

                    @if(canSee('profile'))
                        <li>
                            <a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a>
                        </li>
                    @endif

                    @if(canSee('settings'))
                        <li>
                            <a href="{{route('settings')}}"><i class="fa fa-cogs"></i> <span>Settings</span></a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>


    @yield('content')

</div>


<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/js/feather.min.js')}}"></script>

<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>

{{--    <script src="{{asset('assets/js/script.js')}}"></script>--}}
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>

@yield('scripts')

</body>
</html>
