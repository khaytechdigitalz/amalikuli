@extends('layouts.sidebar')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Buy Now Pay Later</h3>
                            <ul class="breadcrumb">
                                <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Buy Now Pay Later</li>
                            </ul>
                        </div>
                    </div>
                </div>
                     <div class="card-body">
                        <!--                    <div class="box w3-card-4">-->
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="card flex-fill bg-white">
                                     <div class="card-header">
                                        <h5 class="card-title mb-0 text-center">Buy Now Pay Later</h5>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                   <iframe src="https://devapps.intelligra.io:120" style="border:0px #ffffff none;min-height: 1500px;" name="intelligraIFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="100%" width="100%" allowfullscreen=""></iframe>
                                        </center>
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
