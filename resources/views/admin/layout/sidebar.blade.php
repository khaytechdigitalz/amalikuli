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
            <a href="{{url('admin/dashboard')}}" class="logo">
                <img src="{{asset('assets/img/lg.png')}}" alt="Logo">
            </a>
            <a href="{{url('dashboard')}}" class="logo logo-small">
                <img src="{{asset('assets/img/lg.png')}}" alt="Logo" width="30" height="30">
            </a>
        </div>


        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>


        <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>


        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>


        <ul class="nav nav-tabs user-menu">


            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i data-feather="bell"></i> <span class="badge rounded-pill">5</span>
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
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('profile')}}"><i data-feather="user" class="me-1"></i>
                        Profile</a>
                    <a class="dropdown-item" href="{{route('settings')}}"><i data-feather="settings" class="me-1"></i>
                        Settings</a>
                    <a class="dropdown-item" href="{{url('login')}}"><i data-feather="log-out" class="me-1"></i> Logout</a>
                </div>
            </li>

        </ul>

    </div>


    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"><span>Main</span></li>

                    <li>
                        <a class="nav-link" href="{{url('admin/dashboard')}}" ><i data-feather="home"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('admin/all-agents')}}"><i data-feather="users"></i> <span>All Agents</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('admin/all-sub-agents')}}"><i data-feather="users"></i> <span>All Sub-Agents</span></a>
                    </li>
                    <li>
                        <a class="nav-link active" href="{{url('admin/posmanagement')}}"><i class="fa fa-calculator"></i><span>POS Manager</span></a>
                    </li>
                    <li>
                        <a class="nav-link active" href="{{url('admin/kycs')}}"><i class="fa fa-lock"></i>
                        <span>KYC</span></a>
                    </li>
                    <li>
                        <a class="nav-link active" href="{{url('bill-payment')}}"><i class="fa fa-sticky-note"></i>
                            <span>All Bills</span></a>
                    </li>
                    <li>
                        <a class="nav-link active" href="{{url('bills/airtime')}}"><i class="fa fa-network-wired"></i>
                            <span>Buy Airtime</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('users')}}"><i data-feather="users"></i> <span>Users</span></a>
                    </li>
                    <li>
                        <a href="{{route('profile')}}"><i data-feather="user"></i> <span>Profile</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.fee.transfer')}}"><i class="fa fa-money-check"></i>
                            <span>Transfer Fees</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.fee.cashout')}}"><i class="fa fa-money-check"></i>
                            <span>Cashout Fees</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.fee.poswithdrawal')}}"><i class="fa fa-money-check"></i>
                            <span>Pos Withdrawal Fees</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.incentive.flat')}}"><i class="fa fa-money-bill-wave"></i>
                            <span>Incentives (Flat)</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.incentive.percent')}}"><i class="fa fa-money-bill-wave"></i>
                            <span>Incentive (Percentage)</span></a>
                    </li>

                    <li>
                        <a href="{{url('settings/performance')}}"><i class="fa fa-chart-bar"></i>
                            <span>Performance</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.generalsettings')}}"><i data-feather="settings"></i> <span>General Settings</span></a>
                    </li>

                    <li>
                        <a href="{{route('admin.paymentsettings')}}"><i data-feather="shopping-cart"></i> <span>Payment Settings</span></a>
                    </li>

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
