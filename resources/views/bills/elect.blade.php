@extends('layouts.sidebar')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Electricity</h3>
                            <ul class="breadcrumb">
                                <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
<div class="card">
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
                                <form action="#" method="post">
                                    <div  class="form-group">
                                        <label  class="requiredField">
                                            Disco Type
                                            <span class="asteriskField">*</span>
                                        </label>
                                            <select name="id" class="text-success form-control" required>
                                                <option selected="">---------</option>
                                                <option value="162">IKEDC</option>
                                                <option value="163">EKEDC</option>
                                                <option value="164">KEDCO</option>
                                                <option value="165">PHED</option>
                                                <option value="166">JED</option>
                                                <option value="167">IBEDC</option>
                                                <option value="168">KAEDCO</option>
                                                <option value="169">AEDC</option>
                                            </select>
                                    </div>


                                    <div id="metertypeID" class="form-group">
                                        <label for="metertypeID" class=" requiredField">
                                            Meter Type
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="">
                                            <select name="metertype" class="text-success form-control" required="" id="metertype">
                                                <option selected="">---------</option>
                                                <option value="prepaid">PrePaid Meter</option>
                                                <option value="postpaid">PostPaid Meter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn process" id="paybtn"
                                            style="color: white;background-color: #13b10d;margin-bottom:15px;"> Continue
                                    </button>
                                    <!--                        <button type="button" id="verify" class=" btn" style="margin-bottom:15px;">  <span id="process"><i class="fa fa-circle-o-notch fa-spin " style="font-size: 30px;animation-duration: 1s;"></i> Validating Please wait </span>  <span id="displaytext">Validate Meter Number </span></button>-->
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-4 ">
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
