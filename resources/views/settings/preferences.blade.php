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
                            <h5 class="card-title">Preferences</h5>
                        </div>
                        <div class="card-body">

                            <form>
                                <div class="row form-group">
                                    <label for="currencyLabel" class="col-sm-3 col-form-label input-label">Currency</label>
                                    <div class="col-sm-9">
                                        <select class="" id="currencyLabel">
                                            <option>USD - US Dollar</option>
                                            <option>GBP - British Pound</option>
                                            <option>EUR - Euro</option>
                                            <option>INR - Indian Rupee</option>
                                            <option>AUD - Australian Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="languageLabel" class="col-sm-3 col-form-label input-label">Language</label>
                                    <div class="col-sm-9">
                                        <select class="" id="languageLabel">
                                            <option>English</option>
                                            <option>French</option>
                                            <option>German</option>
                                            <option>Italian</option>
                                            <option>Spanish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="timezoneLabel" class="col-sm-3 col-form-label input-label">Time Zone</label>
                                    <div class="col-sm-9">
                                        <select class="" id="timezoneLabel">
                                            <option>English</option>
                                            <option>French</option>
                                            <option>German</option>
                                            <option>Italian</option>
                                            <option>Spanish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="dateformat" class="col-sm-3 col-form-label input-label">Date Format</label>
                                    <div class="col-sm-9">
                                        <select class="" id="dateformat">
                                            <option>2020 Nov 09</option>
                                            <option>09 Nov 2020</option>
                                            <option>09/11/2020</option>
                                            <option>09.11.2020</option>
                                            <option>09-11-2020</option>
                                            <option>11/09/2020</option>
                                            <option>2020/11/09</option>
                                            <option>2020-11-09</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="financialyear" class="col-sm-3 col-form-label input-label">Financial Year</label>
                                    <div class="col-sm-9">
                                        <select class="" id="financialyear">
                                            <option>january-december</option>
                                            <option>february-january</option>
                                            <option>march-february</option>
                                            <option>april-march</option>
                                            <option>may-april</option>
                                            <option>june-may</option>
                                            <option>july-june</option>
                                            <option>august-july</option>
                                            <option>september-august</option>
                                            <option>october-september</option>
                                            <option>november-october</option>
                                            <option>december-november</option>
                                        </select>
                                    </div>
                                </div>

                                <label class="row form-group toggle-switch" for="preferencesSwitch1">
<span class="col-8 col-sm-9 toggle-switch-content ml-0">
<span class="d-block text-dark">Discount Per Item</span>
<span class="d-block text-muted">Enable this if you want to add Discount to individual invoice items. By default, Discount is added directly to the invoice.</span>
</span>
                                    <span class="col-4 col-sm-3">
<input type="checkbox" class="toggle-switch-input" id="preferencesSwitch1">
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
