@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Settings</h3>

                        </div>
                    </div>
                </div>

                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ul>
                <div class="row">
                    <div class="col-xl-3 col-md-4">

                        <div class="widget settings-menu">
                            <ul>
                                <li class="nav-item">
                                    <a href="{{url('settings/pro')}}" class="nav-link">
                                        <i class="far fa-user"></i> <span>Profile Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('settings/preferences')}}" class="nav-link">
                                        <i class="fas fa-cog"></i> <span>Preferences</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('settings/debit-card')}}" class="nav-link">
                                        <i class="far fa-credit-card"></i> <span>Debit Card</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('settings/noti')}}" class="nav-link ">
                                        <i class="far fa-bell"></i> <span>Notifications</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('settings/pass')}}" class="nav-link active">
                                        <i class="fas fa-unlock-alt"></i> <span>Change Password</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('settings/delete')}}" class="nav-link">
                                        <i class="fas fa-ban"></i> <span>Delete Account</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>


                    <div class="col-xl-9 col-md-8">
                        <div class="card">
                            <div class="card-body">

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.update-password-form')
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @livewireScripts
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
@endsection

@section('styles')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
@endsection

