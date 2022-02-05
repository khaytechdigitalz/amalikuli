@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Customers</h3>
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            {{--                        <li class="breadcrumb-item active">Pos Management</li>--}}
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2 mt-4 mb-3">
                    <a href="{{url('add-customer')}}" class="btn btn-primary" role="button"><i
                            class="fa fa-plus-circle"> </i> Add Customer</a>
                </div>

                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>S/N</th>
                                        <th>BVN</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>DOB</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{$i++}}
                                            </td>
                                            <td>
                                                {{$user->bvn}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phoneno}}
                                            </td>
                                            <td>
                                                {{$user->dob}}
                                            </td>
                                            <td>
                                                {{$user->accountName}}
                                            </td>
                                            <td>
                                                {{$user->accountNo}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
