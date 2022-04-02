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

                                <form action="{{route('bills.buydata')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div id="AirtimeNote" class="alert alert-danger"
                                                 style="text-transform: uppercase;font-weight: bold;font-size: 23px;display: none;"></div>
                                            <div id="AirtimePanel">
                                                <div id="div_id_network" class="form-group mt-4">
                                                    <label for="network" class=" requiredField">
                                                        Network Plans<span class="asteriskField">*</span>
                                                    </label>

                                                    <input type="hidden" name="network" value="{{$network}}">
                                                    <div class="mb-3">
                                                        <script>
                                                            function myNewFunction(sel) {
                                                                // alert(sel.options[sel.selectedIndex].id);
                                                                document.getElementById("po").value = (sel.options[sel.selectedIndex].id);
                                                                document.getElementById("pk").value = (sel.options[sel.selectedIndex].text);

                                                            }
                                                        </script>
                                                        <select name="datacode"   class="text-success form-control"  onChange="myNewFunction(this);" required="">
                                                            @foreach($rep as $provider)
                                                                <option>-------------</option>
                                                                <option value="{{$provider['datacode']}}" id="{{$provider['price']}}" >{{$provider['name']}}--₦{{$provider['price']}} {{$provider['datacode']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="name" id="pk" value="" >
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

                                                                                                <div id="div_id_airtimetype" class="form-group">
                                                                                                    <label for="airtimetype_a" class=" requiredField">
                                                                                                        Amount<span class="asteriskField">*</span>
                                                                                                    </label>
                                                                                                    <div class="form-group">
                                                                                                        <input name="amount"
                                                                                                               class="text-success form-control" placeholder="Amount"
                                                                                                               id="po" readonly>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div id="div_id_network" class="form-group">
                                                                                                    <label for="network" class=" requiredField">
                                                                                                        Phone Number<span class="asteriskField">*</span>
                                                                                                    </label>
                                                                                                    <div class="">
                                                                                                        <input type="number" name="phone" class="form-control" placeholder="Phone number" required>
                                                                                                    </div>
                                                                                                </div>

                                                <button type="submit" class="btn"
                                                        style="color: white;background-color: #048047" id="submite">
                                                  Purchase
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
