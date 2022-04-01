@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Airtime TopUp</h3>
                                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="box w3-card-4">
                                <span class="text-muted mt-3 mb-4 text-center" style="font-size: x-small">Complete your payment information</span>

                                <form action="{{route('bill')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div id="AirtimeNote" class="alert alert-danger"
                                                 style="text-transform: uppercase;font-weight: bold;font-size: 23px;display: none;"></div>
                                            <div id="AirtimePanel">
                                                <div id="div_id_network" class="form-group mt-4">
                                                    <label for="network" class=" requiredField">
                                                        Network<span class="asteriskField">*</span>
                                                    </label>

                                                    <div class="mb-3">
                                                        <select name="network" class="text-success form-control" required>
                                                            <option value="mtn">MTN Airtime</option>
                                                            <option value="glo">GLO Airtime</option>
                                                            <option value="9mobile">9mobile Airtime</option>
                                                            <option value="airtel">AIRTEL Airtime</option>
                                                            <option value="Smile">Smile Airtime</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="div_id_airtimetype" class="form-group">
                                                    <label for="airtimetype_a" class=" requiredField">
                                                        Amount<span class="asteriskField">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input name="amount" max="4000" min="100"
                                                               class="text-success form-control" placeholder="Amount"
                                                               id="airtimetype" required>
                                                    </div>
                                                </div>

                                                <div id="div_id_network" class="form-group">
                                                    <label for="network" class=" requiredField">
                                                        Phone Number<span class="asteriskField">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="number" name="phone" class="form-control"
                                                               placeholder="Phone number" required>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn"
                                                        style="color: white;background-color: #048047" id="btnsubmit">
                                                    Purchase Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 ">
                                            <br>
                                            <h6 class="text-center">Codes for Airtime Balance: </h6>
                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-primary">MTN Airtime VTU
                                                    <span id="RightT"> *556#  </span></li>
                                                <li class="list-group-item list-group-item-success"> 9mobile Airtime VTU
                                                    *232#
                                                </li>
                                                <li class="list-group-item list-group-item-action"> Airtel Airtime VTU
                                                    *123#
                                                </li>
                                                <li class="list-group-item list-group-item-info"> Glo Airtime VTU
                                                    #124#.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
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
