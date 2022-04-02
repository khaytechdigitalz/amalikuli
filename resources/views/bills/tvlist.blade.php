@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div style="padding:90px 15px 20px 15px">
            <h5 class="text-center"> Tv Product</h2>
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
                                        @csrf
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
                                {{--                                        <button id="btnv" type="button" onclick="showUser()" class="btn btn-rounded btn-success"> Verify </button>--}}
                                <button type="submit" class="btn"
                                        style="color: white;background-color: #048047"> Renew Plan</button>
                               <a href="{{url('bills.list', ['network'=>$input['network']])}}" ><button type="submit" class="btn"
                                                                                                style="color: white;background-color: #048047"> Change Plan</button></a>
                                <button type="submit" class="btn"
                                        style="color: white;background-color: #048047"> Upgrade Plan</button>
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
