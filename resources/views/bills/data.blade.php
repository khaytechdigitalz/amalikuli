@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Data TopUp</h3>
                                <ul class="bGreadcrumb">
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

                                <form action="{{route('dataplans')}}" method="POST">
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
                                                    <script>
                                                        function showUser() {
                                                            var str= document.getElementById("network").value;

                                                            if (str == "") {
                                                                document.getElementById("plan").innerHTML = "IUC cannot be empty";
                                                                document.getElementById("submit").removeAttribute("disabled");
                                                                return;
                                                            } else {
                                                                document.getElementById("submite").innerText="loading....";
                                                                var xmlhttp = new XMLHttpRequest();
                                                                xmlhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        document.getElementById("submite").innerText="Verify";
                                                                        if(this.responseText=="fail"){
                                                                            document.getElementById("plan").innerHTML = "Error validating IUC Number";
                                                                            document.getElementById("submite").setAttribute("disabled", "true");
                                                                        }else{
                                                                            document.getElementById("plan").innerHTML = this.responseText;
                                                                            document.getElementById("submite").removeAttribute("disabled");
                                                                        }
                                                                    }
                                                                };
                                                                xmlhttp.open("GET","{{ route('dataplans', '/') }}/'id",true);
                                                                xmlhttp.send();
                                                            }
                                                        }
                                                    </script>
                                                    <div class="mb-3">
                                                        <select name="id" class="text-success form-control" required="">
                                                            @foreach($providers as $provider)
                                                                <option value="{{$provider->service_type}}">{{$provider->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
{{--                                                    <button id="network" type="button" onclick="showUser()"  class="btn"--}}
{{--                                                            style="color: white;background-color: #048047" > Get Plan </button>--}}

                                                </div>


{{--                                                <div id="div_id_network" class="form-group mt-4">--}}
{{--                                                    <label for="network" class=" requiredField">--}}
{{--                                                        Plans<span class="asteriskField">*</span>--}}
{{--                                                    </label>--}}

{{--                                                    <div class="mb-3">--}}
{{--                                                        <select name="plan" class="text-success form-control" required="">--}}
{{--                                                            <option value="1">1GB - 30days</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="div_id_airtimetype" class="form-group">--}}
{{--                                                    <label for="airtimetype_a" class=" requiredField">--}}
{{--                                                        Amount<span class="asteriskField">*</span>--}}
{{--                                                    </label>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <input name="airtimetype" max="4000" min="100"--}}
{{--                                                               class="text-success form-control" placeholder="Amount"--}}
{{--                                                               id="amount" readonly>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="div_id_network" class="form-group">--}}
{{--                                                    <label for="network" class=" requiredField">--}}
{{--                                                        Phone Number<span class="asteriskField">*</span>--}}
{{--                                                    </label>--}}
{{--                                                    <div class="">--}}
{{--                                                        <input type="phone" class="form-control" placeholder="Phone number" required>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <button type="submit" class="btn"
                                                        style="color: white;background-color: #048047" id="submite">
                                                    Get Plan
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 ">
                                            <br>
                                            <h6 class="text-center">Codes for Data Balance: </h6>
                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-secondary">MTN [SME]     *461*4#  </li>
                                                <li class="list-group-item list-group-item-primary">MTN [Gifting]     *131*4# or *460*260#  </li>
                                                <li class="list-group-item list-group-item-dark"> 9mobile [Gifting]   *228# </li>
                                                <li class="list-group-item list-group-item-action"> Airtel   *140# </li>
                                                <li class="list-group-item list-group-item-success"> Glo  *127*0#. </li>
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
