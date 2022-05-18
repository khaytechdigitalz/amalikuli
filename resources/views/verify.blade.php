@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Money Transfer</h3>
                                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('walletHistory')}}">Wallet</a></li>
                                    {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    {{--                                <h4 class="card-title">Basic Info</h4>--}}
                                    <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


                                                <form action="{{route('pay')}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Customer Account Name</label>
                                                                <div class="">
                                                                    <input type="text" name="accountname" id="value" class="text-success  form-control" value="{{$rep1}}" readonly required="" >
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Account Number</label>
                                                                <input  type="tel" id="tvphone1" class="form-control" value="{{$request->number}}" name="number" readonly>
                                                                {{--                                                    <button id="btnv1" type="button" onclick="shoUser()">Verify</button>--}}
                                                                {{--                                                    <b class="text-success fa-bold" id="vtv1"></b>--}}
                                                            </div>
                                                                <div class="form-group">
                                                                    <input  type="hidden"  class="form-control" name="bankcode" value="{{$request->bankcode}}" readonly>
                                                                    <input  type="hidden"  class="form-control" name="accountbvn" value="{{$bvn}}" readonly>
                                                                    <input  type="hidden"  class="form-control" name="sessionID" value="{{$idc}}" readonly>
                                                                    <input  type="hidden"  class="form-control" name="refe" value="{{rand(10000000, 999999999)}}" readonly>
                                                                </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="amount">Narration</label>
                                                                <input type="text" name="narration" class="form-control"
                                                                       placeholder="Narration" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Enter Amount</label>
                                                                <input type="number"  class="form-control" placeholder="e.g 100"  name="amount" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Make Transfer</button>
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

