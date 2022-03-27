@extends('admin.layout.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Create Poswithdrawal Fee</h3>
                                <ul class="breadcrumb">
                                    <li class=""><a href="#">Poswithdrawal</a></li>
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

                                    <form action="{{route('admin.fee.poswithdrawal.update')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fee (Flat)</label>
                                                    <input name="id" type="hidden" class="form-control" value="{{$data->id}}" required>
                                                    <input name="fee" type="tel" class="form-control" value="{{$data->fee}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Maximum Range</label>
                                                    <input name="range_set" type="tel" class="form-control" value="{{$data->range_set}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input name="description" type="tel" class="form-control" value="{{$data->description}}" required>
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Fee (percent)</label>
                                                    <input name="fee_percent" type="tel" class="form-control" value="{{$data->fee_percent}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Minimum Fee</label>
                                                    <input name="minimum_fee" type="tel" class="form-control" value="{{$data->minimum_fee}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Capped Fee</label>
                                                    <input name="capped_fee" type="tel" class="form-control" value="{{$data->capped_fee}}" required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Update Fee</button>
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

