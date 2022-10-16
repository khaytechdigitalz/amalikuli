@extends('layouts.sidebar')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Cable Subscription</h3>

                        </div>
                    </div>
                </div>

                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Cable TV</li>
                                </ul>
{{--                <div class="card">--}}
                    <div class="card-body">
                        <!--                    <div class="box w3-card-4">-->
                        <div class="row">

                            <div class="col-sm-8">
                                <br>
                                <br>
                                <div class="alert alert-danger" id="ElectNote" style="text-transform: uppercase;font-weight: bold;font-size: 18px;display: none;">
                                </div>
                                <div id="electPanel">
                                    <div class="alert alert-danger">0.1% discount apply.</div>
                                    <form action="{{route('bills.tvlist')}}" method="post">
                                        @csrf
                                        <div id="discotypeID" class="form-group">
                                            <label for="discotypeID" class=" requiredField">
                                               Select Your Tv
                                            </label>
                                            <div class="">
                                                <select name="network" class="text-success  form-control" required="" >
                                                    <option value="gotv" selected>Gotv</option>
                                                    <option value="dstv">Dstv</option>
                                                    <option value="startimes">Startime</option>

                                                </select>
                                            </div>
                                        </div>

                                            <label for="metertypeID" class=" requiredField">
                                                Enter IUC Number
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <div class="">
                                                <input class="form-control text-success" type="tel" placeholder="Enter IUC number" maxlength="11" minlength="9" id="tvphone" name="phone" value="" autocomplete="on" size="20" required="">
                                            </div>
                                        </div>
{{--                                        <button id="btnv" type="button" onclick="showUser()" class="btn btn-rounded btn-success"> Verify </button>--}}
                                        <button type="submit" class="btn mt-3"
                                                style="color: white;background-color: #048047"> Continue </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                            </div>

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>

                    <br>
                    <br>
                    <br>
                    <br>
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
