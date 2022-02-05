@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Bills Receipt</h3>
                                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Bills</a></li>
                                    {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="box w3-card-4">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="{{asset('assets/img/lg.png')}}" alt="Logo" width="150"
                                                 height="70">
                                        </div>

                                        <span class="text-muted text-center mt-3 mb-3" style="font-size: small">Find your payment receipt below</span>

                                        <hr class="col-12 mt-2 mb-2" style="color: #0c4128; outline-style: dashed">

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <span class="text-muted">Phone Number</span> <br/>
                                                <span style="font-weight: bolder">08166939205</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-muted">Transaction</span> <br/>
                                                <span style="font-weight: bolder">Airtime</span>
                                            </div>

                                        </div>

                                        <hr class="col-12 mt-2 mb-2" style="color: #0c4128; outline-style: dashed">

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <span class="text-muted">Network</span> <br/>
                                                <span style="font-weight: bolder">MTN</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="text-muted">Amount</span> <br/>
                                                <span style="font-weight: bolder">N100</span>
                                            </div>

                                        </div>

                                        <hr class="col-12 mt-2 mb-2" style="color: #0c4128; outline-style: dashed">

                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <span class="text-muted">Total</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-weight: bolder">N100</span>
                                            </div>
                                        </div>
                                        {{--                                        <hr style="color: #0c4128; outline-style: dashed">--}}

                                        <div class="text-center">
                                            <svg class="col-8" height="80px" x="0px" y="0px" viewBox="0 0 316 80"
                                                 xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                 style="transform: translate(0,0)">
                                                <rect x="0" y="0" width="316" height="80" style="fill:#ffffff;"></rect>
                                                <g transform="translate(10, 20)" style="fill:#000000;">
                                                    <rect x="0" y="0" width="2.42" height="50"></rect>
                                                    <rect x="3.63" y="0" width="1.21" height="50"></rect>
                                                    <rect x="7.259999999999999" y="0" width="1.21" height="50"></rect>
                                                    <rect x="13.309999999999999" y="0" width="1.21" height="50"></rect>
                                                    <rect x="16.939999999999998" y="0" width="2.42" height="50"></rect>
                                                    <rect x="24.2" y="0" width="1.21" height="50"></rect>
                                                    <rect x="26.619999999999997" y="0" width="1.21" height="50"></rect>
                                                    <rect x="30.249999999999996" y="0" width="4.84" height="50"></rect>
                                                    <rect x="36.3" y="0" width="1.21" height="50"></rect>
                                                    <rect x="39.93" y="0" width="1.21" height="50"></rect>
                                                    <rect x="43.56" y="0" width="4.84" height="50"></rect>
                                                    <rect x="49.61" y="0" width="1.21" height="50"></rect>
                                                    <rect x="53.239999999999995" y="0" width="1.21" height="50"></rect>
                                                    <rect x="55.66" y="0" width="1.21" height="50"></rect>
                                                    <rect x="59.28999999999999" y="0" width="4.84" height="50"></rect>
                                                    <rect x="66.55" y="0" width="1.21" height="50"></rect>
                                                    <rect x="68.97" y="0" width="4.84" height="50"></rect>
                                                    <rect x="76.23" y="0" width="1.21" height="50"></rect>
                                                    <rect x="79.86" y="0" width="3.63" height="50"></rect>
                                                    <rect x="85.91000000000001" y="0" width="1.21" height="50"></rect>
                                                    <rect x="89.53999999999999" y="0" width="2.42" height="50"></rect>
                                                    <rect x="93.17" y="0" width="1.21" height="50"></rect>
                                                    <rect x="95.59" y="0" width="3.63" height="50"></rect>
                                                    <rect x="101.64" y="0" width="2.42" height="50"></rect>
                                                    <rect x="106.48" y="0" width="1.21" height="50"></rect>
                                                    <rect x="108.9" y="0" width="3.63" height="50"></rect>
                                                    <rect x="114.94999999999999" y="0" width="2.42" height="50"></rect>
                                                    <rect x="119.78999999999999" y="0" width="4.84" height="50"></rect>
                                                    <rect x="127.05" y="0" width="1.21" height="50"></rect>
                                                    <rect x="129.47" y="0" width="1.21" height="50"></rect>
                                                    <rect x="133.1" y="0" width="4.84" height="50"></rect>
                                                    <rect x="140.35999999999999" y="0" width="1.21" height="50"></rect>
                                                    <rect x="142.78" y="0" width="1.21" height="50"></rect>
                                                    <rect x="146.41" y="0" width="4.84" height="50"></rect>
                                                    <rect x="153.67" y="0" width="1.21" height="50"></rect>
                                                    <rect x="156.08999999999997" y="0" width="1.21" height="50"></rect>
                                                    <rect x="159.72" y="0" width="1.21" height="50"></rect>
                                                    <rect x="163.35" y="0" width="2.42" height="50"></rect>
                                                    <rect x="168.19" y="0" width="3.63" height="50"></rect>
                                                    <rect x="173.03" y="0" width="1.21" height="50"></rect>
                                                    <rect x="179.07999999999998" y="0" width="1.21" height="50"></rect>
                                                    <rect x="181.5" y="0" width="2.42" height="50"></rect>
                                                    <rect x="186.33999999999997" y="0" width="1.21" height="50"></rect>
                                                    <rect x="192.39000000000001" y="0" width="2.42" height="50"></rect>
                                                    <rect x="196.01999999999998" y="0" width="1.21" height="50"></rect>
                                                    <rect x="199.64999999999998" y="0" width="1.21" height="50"></rect>
                                                    <rect x="205.7" y="0" width="1.21" height="50"></rect>
                                                    <rect x="208.12" y="0" width="2.42" height="50"></rect>
                                                    <rect x="212.95999999999998" y="0" width="1.21" height="50"></rect>
                                                    <rect x="217.79999999999998" y="0" width="4.84" height="50"></rect>
                                                    <rect x="223.85" y="0" width="1.21" height="50"></rect>
                                                    <rect x="226.26999999999998" y="0" width="1.21" height="50"></rect>
                                                    <rect x="229.9" y="0" width="2.42" height="50"></rect>
                                                    <rect x="234.74" y="0" width="3.63" height="50"></rect>
                                                    <rect x="239.58" y="0" width="2.42" height="50"></rect>
                                                    <rect x="246.83999999999997" y="0" width="1.21" height="50"></rect>
                                                    <rect x="249.26" y="0" width="1.21" height="50"></rect>
                                                    <rect x="252.89" y="0" width="1.21" height="50"></rect>
                                                    <rect x="256.52" y="0" width="2.42" height="50"></rect>
                                                    <rect x="260.15000000000003" y="0" width="1.21" height="50"></rect>
                                                    <rect x="266.2" y="0" width="1.21" height="50"></rect>
                                                    <rect x="269.83" y="0" width="1.21" height="50"></rect>
                                                    <rect x="274.66999999999996" y="0" width="2.42" height="50"></rect>
                                                    <rect x="279.51" y="0" width="2.42" height="50"></rect>
                                                    <rect x="285.56" y="0" width="3.63" height="50"></rect>
                                                    <rect x="290.40000000000003" y="0" width="1.21" height="50"></rect>
                                                    <rect x="292.82" y="0" width="2.42" height="50"></rect>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="row text-center mt-2">
                                            <div class="col-6">
                                                <button type="button" onclick="print()" class="btn"
                                                        style="color: white;background-color: #048047" id="btnsubmit">
                                                    Print
                                                    Now
                                                </button>
                                            </div>

                                            <div class="col-6">
                                                <a href="{{route('transactions')}}" class="btn btn-secondary">
                                                    See History
                                                </a>
                                            </div>

                                        </div>

                                    </div>
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

@endsection
