@extends('layouts.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Bill-Payment</h3>

                        </div>
                    </div>
                </div>


                                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">BIlls Payment</li>
                                </ul>




                <section class="comp-section comp-cards">
                    <div class="section-header">
                        <div class="line"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="card flex-fill bg-white">
                                <img alt="Card Image" src="{{asset('assets/img/bet.jpg')}}" class="card-img-top">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Fund Betting Providers</h5>
                                </div>
                                <div class="card-body">
                                    <center>
                                    <p class="card-text">Funding your betting app wallet trough our platform</p>
                                    <a class="btn btn-success" href="#">Select</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="card flex-fill bg-white">
                                <img alt="Card Image" src="{{asset('assets/img/cab.jpg')}}" class="card-img-top">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-center">Cable Subscription</h5>
                                </div>
                                <div class="card-body">
                                    <center>
                                    <p class="card-text">Instantly Activate Cable subscription with favourable discount compare to others</p>
                                    <a class="btn btn-success" href="{{url('bills/tv')}}">Select</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="card flex-fill bg-white">
                                <img alt="Card Image" src="{{asset('assets/img/cab1.jpg')}}" class="card-img-top">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-center">Electricity</h5>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <p class="card-text">Instantly Electricity with favourable discount compare to
                                            others</p>
                                        <a class="btn btn-success" href="{{route('bills.elect')}}">Select</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
