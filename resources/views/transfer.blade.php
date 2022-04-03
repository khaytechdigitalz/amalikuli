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

                                    <script>
                                        function shoUser() {
                                            var str= document.getElementById("tvphone1").value;
                                            var k= document.getElementById("value").value;

                                            if (str == "") {
                                                document.getElementById("vtv1").innerHTML = "IUC cannot be empty";
                                                document.getElementById("btnd1").removeAttribute("disabled");
                                                return;
                                            } else if (str.length<9) {
                                                document.getElementById("vtv1").innerHTML = "IUC is too short";
                                                document.getElementById("btnd1").removeAttribute("disabled");
                                                return;
                                            } else {
                                                document.getElementById("btnv1").innerText="Verify....";
                                                var xmlhttp = new XMLHttpRequest();
                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        document.getElementById("btnv1").innerText="Verify";
                                                        if(this.responseText=="fail"){
                                                            document.getElementById("vtv1").innerHTML = "Error validating IUC Number";
                                                            document.getElementById("btnd1").setAttribute("disabled", "true");
                                                        }else{
                                                            document.getElementById("vtv1").innerHTML = this.responseText;
                                                            document.getElementById("btnd1").removeAttribute("disabled");
                                                        }
                                                    }
                                                };
                                                xmlhttp.open("GET",{{ route('tran', '/') }}"number"=+str+"+&networkcode="+k,true);
                                                xmlhttp.send();
                                            }
                                        }
                                    </script>

                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Bank</label>
                                                    <div class="">
                                                        <select name="bankcode" id="value" class="text-success  form-control" required="" >
                                                            @foreach($rep1 as $plan)
{{--                                                            <option selected="">---------</option>--}}
                                                            <option value="{{$plan['code']}}">{{$plan['name']}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input  type="tel" id="tvphone1" class="form-control" name="number"><button id="btnv1" type="button" onclick="shoUser()">Verify</button>
                                                    <b class="text-success fa-bold" id="vtv1"></b>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" name="amount" id="amount" class="form-control"
                                                           placeholder="Enter amount" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="amount">Transfer Note</label>
                                                    <textarea name="note" class="form-control"
                                                              placeholder="Enter tranfer note">Transfer from Amali</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary">Transfer</button>
                                        </div>
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

