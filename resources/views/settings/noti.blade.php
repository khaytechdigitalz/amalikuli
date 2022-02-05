@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Settings</h3>
                                <ul class="breadcrumb">
                                <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @include('settings.settings_menu')



<div class="col-xl-9 col-md-8">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Notifications</h5>
            <p>Which email notifications would you like to receive when something changes?</p>
        </div>
        <div class="card-body">

            <form>
                <div class="row form-group">
                    <label for="notificationmail" class="col-sm-3 col-form-label input-label">Send Notifications to</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="notificationmail">
                    </div>
                </div>

                <label class="row form-group toggle-switch" for="notification_switch1">
<span class="col-8 col-sm-9 toggle-switch-content ms-0">
<span class="d-block text-dark">Invoice viewed</span>
<span class="d-block text-muted">When your customer views the invoice sent via dashboard.</span>
</span>
                    <span class="col-4 col-sm-3">
<input type="checkbox" class="toggle-switch-input" id="notification_switch1">
<span class="toggle-switch-label ms-auto">
<span class="toggle-switch-indicator"></span>
</span>
</span>
                </label>


                <label class="row form-group toggle-switch" for="notification_switch2">
<span class="col-8 col-sm-9 toggle-switch-content ms-0">
<span class="d-block text-dark">Estimate viewed</span>
<span class="d-block text-muted">When your customer views the estimate sent via dashboard.</span>
</span>
                    <span class="col-4 col-sm-3">
<input type="checkbox" class="toggle-switch-input" id="notification_switch2">
<span class="toggle-switch-label ms-auto">
<span class="toggle-switch-indicator"></span>
</span>
</span>
                </label>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

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
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
@endsection
