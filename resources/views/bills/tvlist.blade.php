@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div style="padding:90px 15px 20px 15px">
            <h5 class="text-center"> Tv Product</h5>
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
{{--                                    <form action="#" >--}}
{{--                                        @csrf--}}
                                        <div id="discotypeID" class="form-group">
                                            <label for="discotypeID" class=" requiredField">
                                               Profile Name
                                            </label>
                                            <div class="">
                                                <input type="text" value="{{$rep1}}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <label for="metertypeID" class=" requiredField">
                                           Current Plan
                                            <span class="asteriskField">*</span>
                                        </label>
                                        <div class="">
                                            <input class="form-control text-success" type="text"   value="{{$rep2}}" autocomplete="on" size="20" readonly>
                                        </div>
                                </div>
                            </div>


{{--                                <center>--}}
{{--                                    <section class="comp-section comp-cards">--}}
                                    <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
{{--                                                                       <button id="btnv" type="button" onclick="showUser()" class="btn btn-rounded btn-success"> Verify </button>--}}
{{--                                <button type="submit" class="btn"--}}
{{--                                        style="color: white;background-color: #048047"> Renew Plan</button>--}}
                                </div>
                                <form action="{{route('bills.list')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="network" value="{{$input['network']}}">
                                    <input type="hidden" name="phone" value="{{$input['phone']}}">
                                    <input type="hidden" name="name" value="{{$rep1}}">
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <button type="submit" class="btn"
                                       style="color: white;background-color: #048047"> Change Plan</button>
                                    </div>
                                </form>
{{--                                    <div class="col-12 col-md-6 col-lg-4 d-flex">--}}
{{--                                    <button type="submit" class="btn"--}}
{{--                                        style="color: white;background-color: #048047"> Upgrade Plan</button>--}}
                                </div>
{{--                                </form>--}}
                            </div>
{{--                                    </section>--}}
{{--                                </center>--}}
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
