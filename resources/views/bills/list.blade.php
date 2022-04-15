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
                                <form action="{{route('bills.changeTVSub')}}" method="post" >
                                    @csrf
                                <div id="discotypeID" class="form-group">
                                    <label for="discotypeID" class=" requiredField">
                                        Profile Name
                                    </label>
                                    <div class="">
                                        <input type="text" name="na" value="{{$input['name']}}" class="form-control" readonly>
                                    </div>
                                </div>

                                <div id="discotypeID" class="form-group">
                                    <label for="discotypeID" class=" requiredField">
                                        TV Type
                                    </label>
                                    <div class="">
                                        <input type="text" name="network" value="{{$input['network']}}" class="form-control" readonly>
                                    </div>
                                </div>

                                <div id="discotypeID" class="form-group">
                                    <label for="metertypeID" class=" requiredField">
                                      IUC Number
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="">
                                        <input class="form-control text-success" type="text" name="phone"   value="{{$input['phone']}}" autocomplete="on" size="20" readonly>

                                    </div>
                                </div>

                                <div id="discotypeID" class="form-group">
                                    <label for="discotypeID" class=" requiredField">
                                        Select Month
                                    </label>
                                    <div class="">
                                        <select name="period" class="text-success  form-control" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="discotypeID" class="form-group">
                                    <label for="discotypeID" class=" requiredField">
                                        Select Your Tv bouquet type
                                    </label>
                                    <div class="">
                                        <select name="code" class="text-success  form-control" required>
                                            @foreach($rep1 as $jv)
                                                <option value="{{$jv['code']}}">{{$jv['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>


{{--                                                        <center>--}}
                        {{--                                    <section class="comp-section comp-cards">--}}
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 d-flex">
{{--                                                                                                       <button id="btnv" type="button" onclick="showUser()" class="btn btn-rounded btn-success"> Verify </button>--}}
                                                                <button type="submit" class="btn"
                                                                        style="color: white;background-color: #048047"> Submit</button>
                            </div>
                            {{--                                    <div class="col-12 col-md-6 col-lg-4 d-flex">--}}
                            {{--                                    <button type="submit" class="btn"--}}
                            {{--                                        style="color: white;background-color: #048047"> Upgrade Plan</button>--}}
                        </div>
                                                        </form>
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
