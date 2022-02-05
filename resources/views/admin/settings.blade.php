@extends("admin.layout.sidebar")
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12">

                     
                            <h4 class="page-title">General Settings</h4>  
                       
             
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
                        <b>SYSTEM SETTINGS</b>
                            <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold"> @lang('Site Title') </label>
                                    <input class="form-control form-control-lg" type="text" name="sitename" value="{{$general->sitename}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Currency')</label>
                                    <input class="form-control form-control-lg" type="text" name="cur_text" value="{{$general->cur_text}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Currency Symbol') </label>
                                    <input class="form-control form-control-lg" type="text" name="cur_sym" value="{{$general->cur_sym}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <b>FLOAT SETTINGS</b>
                            <hr>
                            <div class="row">


                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Amount') ({{$general->cur_sym}})</label>
                                    <input class="form-control form-control-lg" type="text" name="float_min" value="{{$general->float_min_amount}}">
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Maximum Amount') ({{$general->cur_sym}})</label>
                                    <input class="form-control form-control-lg" type="text" name="float_max" value="{{$general->float_max_amount}}">
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Daily Transaction')  {{$general->cur_sym}}</label>
                                    <input class="form-control form-control-lg" type="text" name="float_min_trx" value="{{$general->float_min_trx}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Daily Transaction Count') </label>
                                    <input class="form-control form-control-lg" type="text" name="float_min_count" value="{{$general->float_min_count}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Agent Months') </label>
                                    <input class="form-control form-control-lg" type="text" name="float_min_month" value="{{$general->float_min_month}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Tenure') (Days)</label>
                                    <input class="form-control form-control-lg" type="text" name="float_min_tenure" value="{{$general->float_min_tenure}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Minimum Tenure') (Days) </label>
                                    <input class="form-control form-control-lg" type="text" name="float_max_tenure" value="{{$general->float_max_tenure}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Interest') (Flat)</label>
                                    <input class="form-control form-control-lg" type="text" name="float_int_flat" value="{{$general->float_int_flat}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Interest') (%)</label>
                                    <input class="form-control form-control-lg" type="text" name="float_int_percent" value="{{$general->float_int_percent}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-group  mb-1">
                                    <label class="form-control-label font-weight-bold">@lang('Float Processing Fee') ({{$general->cur_sym}})</label>
                                    <input class="form-control form-control-lg" type="text" name="float_fee" value="{{$general->float_fee}}">
                                </div>
                            </div>


                            
                        </div>
                        <br>
                         

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
