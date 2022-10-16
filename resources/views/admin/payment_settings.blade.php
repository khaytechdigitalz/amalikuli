@extends("admin.layout.sidebar")
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12">


                            <h4 class="page-title">Payment Settings</h4>


                    <div class="card-body">
                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <br>
                    <form action="" method="POST">
                        @csrf

                        <hr>
                        <b>PAYMENT SETTINGS</b>
                            <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold"> @lang('Deposit Fee') </label>
                                    <input class="form-control form-control-lg" type="text" name="deposit_charge" value="{{$general->deposit_charge}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Withdrawal Fee')</label>
                                    <input class="form-control form-control-lg" type="text" name="withdrawal_charge" value="{{$general->withdrawal_charge}}">
                                </div>
                            </div>

            <div class="col-md-6">
                <div class="form-group  mb-1">
                    <label class="form-control-label font-weight-bold">@lang('Transfer Fee') </label>
                    <input class="form-control form-control-lg" type="text" name="transfer_charge" value="{{$general->transfer_charge}}">
                </div>
            </div>
            </div>
            <br>
            <div class="row">


<div class="col-md-6">
    <div class="form-group  mb-1">
        <label class="form-control-label font-weight-bold">@lang('Cable TV Subscription Charge') </label>
        <input class="form-control form-control-lg" type="text" name="cabletv_charge" value="{{$general->cabletv_charge}}">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group  mb-1">
        <label class="form-control-label font-weight-bold">@lang('Electricity Bill Payment Charge') </label>
        <input class="form-control form-control-lg" type="text" name="utility_charge" value="{{$general->utility_charge}}">
    </div>
</div>
                        </div>


                        <div class="form-group">
                        <br>
                            <button type="submit" class="btn text-white btn-primary btn-block btn-sm">@lang('Update Settings')</button>
                        </div>
                    </form>
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

@endsection
