@extends("admin.layout.sidebar")
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">View Document</h3>  
                        </div>
                    </div>
                </div>

                    <div class="card-body">
                        <!--                    <div class="box w3-card-4">-->
                        <a href="{{route('admin.kyc.approve',$kyc->id)}}" class="btn btn-primary btn-sm"> Approve KYC</a>
                        <a href="{{route('admin.kyc.reject',$kyc->id)}}" class="btn btn-danger btn-sm"> Reject KYC</a><hr>
                        @php
                                    $user = App\Models\User::whereId($kyc->user_id)->first();
                                    @endphp
                         <b>   Agent Name: {{$user->firstname ?? ""}} {{$user->lastname ?? ""}}<br>
                            Agent Email: {{$user->email ?? ""}}<br>
                            Agent Phone: {{$user->phone ?? ""}}<br>
                            Agent KYC Status: @if($kyc->status == 1) <a class="text-success">Approved</a> @elseif($kyc->status == 2)  <a class="text-danger">Rejected</a> @else <a class="text-warning">Pending</a> @endif<br></b></b>

<br>          
@if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                                  <div class="row">
                       
                            <div class="col-12 col-md-6 col-lg-6 d-flex">
                                <div class="card flex-fill bg-white">
                                    <img width="150" height="150" alt="Card Image" src="{{asset($kyc->utility)}}" class="card-img-top">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-center">Utility Bill </h5>
                                                                            </div>
                                    <div class="card-body">
                                        <center>
                                            <a class="btn btn-sm  btn-success" href="{{asset($kyc->utility)}}" download>Download</a>
                                        </center>
                                    </div>
                                </div>
                            </div>




                            <div class="col-12 col-md-6 col-lg-6 d-flex">
                                <div class="card flex-fill bg-white">
                                    <img width="150" height="150" alt="Card Image" src="{{asset($kyc->idcard)}}" class="card-img-top">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-center">ID Card</h5>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <a class="btn  btn-sm btn-success" href="{{asset($kyc->idcard)}}" download>Download</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex">
                                <div class="card flex-fill bg-white">
                                  <!--  <img width="150" height="150" alt="Card Image" src="{{asset($kyc->guarantorform)}}" class="card-img-top">-->
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-center">Guarantor's ID</h5>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <a class="btn  btn-sm btn-success" href="{{asset($kyc->guarantorform)}}" download>Download</a>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 d-flex">
                                <div class="card flex-fill bg-white">
                                    <img width="150" height="150" alt="Card Image" src="{{asset($kyc->passport)}}" class="card-img-top">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-center">Passport</h5>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <a class="btn btn-sm btn-success" href="{{asset($kyc->passport)}}" download>Download</a>
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
