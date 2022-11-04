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
    <style>
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
</style>

<!--[if lt IE 9]>
    <script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/respond.min.js')}}"></script>
    <![endif]-->

    @yield('styles')
    @stack('styles')
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
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('dashboard')}}"><i class="fa fa-home"></i>
                                <span>Dashboard</span></a>
                        </li>
                    @endif
                    <hr>

                    @if(canSee('agents'))

                    <li  class="{{ Request::is('agents') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('agents')}}"><i class="fa fa-user-friends"></i>
                                <span>Sub Agents</span></a>
                        </li>

                        <li  class="{{ Request::is('terminals') ? 'active' : '' }}">
                            <a href="{{route('terminals')}}"><i class="fa fa-mobile"></i> <span>Terminals</span></a>
                        </li>

                    @endif

                        <li  class="{{ Request::is('add-sub-agent') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('addSubAgent')}}"><i class="fa fa-user-friends"></i>
                                <span>Add Agents</span></a>
                        </li>

                  <hr>


                    <li class="nav-link"><b>PRODUCTS</b></li>
                    @if(canSee('customers'))
                    <li  class="{{ Request::is('customers') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('customers')}}"><i class="fa fa-plus"></i>
                                <span>Open Account</span></a>
                        </li>
                    @endif

                    @if(canSee('pay-bills'))
                        <li>
                            <a class="nav-link active" href="#{{url('bill-payment')}}"><i class="fa fa-lock"></i>
                                <span>Insurance</span></a>
                        </li>
                        <li>
                            <a class="nav-link active" href="#{{url('bill-payment')}}"><i class="fa fa-piggy-bank"></i>
                                <span>Savings</span></a>
                        </li>
                        <li>
                            <a class="nav-link active" href="{{route('buynpl')}}"><i class="fa fa-shopping-cart"></i>
                                <span>Buy Now Pay Later</span></a>
                        </li>

                        <li  class="{{ Request::is('bill-payment') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{url('bill-payment')}}"><i class="fa fa-desktop"></i>
                                <span>Pay Bills</span></a>
                        </li>
                        @if(canSee('buy-airtime'))
                    <li  class="{{ Request::is('airtime') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{route('bills.airtime')}}"><i
                                    class="fa fa-phone"></i>
                                <span>Buy Airtime</span></a>
                        </li>


                    @endif

                        @if(canSee('buy-data'))
                        <li  class="{{ Request::is('bills.data') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{route('bills.data')}}"><i
                                    class="fa fa-wifi"></i>
                                <span>Buy Data</span></a>
                        </li>
                       @endif
                    @else
                    <li  class="{{ Request::is('bill-payment') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{url('bill-payment')}}"><i class="fa fa-desktop"></i>
                                <span>Pay Bills</span></a>
                        </li>
                        <li  class="{{ Request::is('bills.airtime') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{route('bills.airtime')}}"><i
                                    class="fa fa-phone"></i>
                                <span>Buy Airtime</span></a>
                        </li>
                        <li  class="{{ Request::is('bills.data') ? 'active' : '' }}">
                            <a class="nav-link active" href="{{route('bills.data')}}"><i
                                    class="fa fa-wifi"></i>
                                <span>Buy Data</span></a>
                        </li>



                    @endif





                    {{--                    <li>--}}
                    {{--                        <a class="nav-link active" href="{{url('posmanagement')}}"><i class="fa fa-terminal"></i>--}}
                    {{--                            <span>Posmanagement</span></a>--}}
                    {{--                    </li>--}}



                    @if(canSee('debit-card'))

                    <li  class="{{ Request::is('debit-card') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('debit-card')}}"><i class="fa fa-credit-card"></i>
                                <span>Debit Card</span></a>
                        </li>
                    @endif



                    @if(canSee('performance'))
                    <li  class="{{ Request::is('agent.performance') ? 'active' : '' }}">
                            <a href="#{{route('agent.performance')}}"><i class="fa fa-chart-bar"></i>
                                <span>Performance</span></a>
                        </li>
                    @endif

                    @if(canSee('terminals'))

                    @endif


                    @if(canSee('transactions'))
                    <li  class="{{ Request::is('transactions') ? 'active' : '' }}">
                            <a href="{{route('transactions')}}"><i class="fa fa-retweet"></i>
                                <span>Transactions</span></a>
                        </li>
                    @endif
                    <hr>


                    @if(canSee('debit-card'))
                    <li class="nav-link"><b>FLOAT MANAGER</b></li>

                    <li  class="{{ Request::is('float') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('float')}}"><i class="fa fa-gift"></i>
                                <span>Request Float</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('floatloan')}}"><i class="fa fa-percent"></i>
                                <span>My Loan</span></a>
                        </li>
                    @endif
                    <hr>




                    @if(canSee('wallet-withdraw'))
                    <li class="nav-link"><b>WALLET MANAGER</b></li>

                    <li  class="{{ Request::is('transfer') ? 'active' : '' }}">
                            <a href="{{route('transfer')}}"><i class="fa fa-wallet"></i>
                                <span>Withdrawal </span></a>
                        </li>
                    @endif
                    @if(canSee('wallet-history'))
                    <li  class="{{ Request::is('walletHistory') ? 'active' : '' }}">
                            <a href="{{route('walletHistory')}}"><i class="fa fa-retweet"></i>
                                <span>Wallet History</span></a>
                        </li>
                    @endif

                    @if(canSee('wallet-transfer'))
                    <li  class="{{ Request::is('walletTransfer') ? 'active' : '' }}">
                            <a href="{{route('walletTransfer')}}"><i class="fa fa-arrow-alt-circle-right"></i>
                                <span>Wallet Transfer</span></a>
                        </li>
                    @endif


                    <li class="nav-link"><b>ACCOUNT SETTINGS</b></li>

                    @if(canSee('profile'))
                    <li  class="{{ Request::is('profile') ? 'active' : '' }}">
                            <a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a>
                        </li>
                    @endif

                    @if(canSee('settings'))
                    <li  class="{{ Request::is('settings') ? 'active' : '' }}">

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
@stack('script')

</body>
</html>
