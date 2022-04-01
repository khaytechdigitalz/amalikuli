@extends('admin.layout.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Incentive Flat</h3>
                        <ul class="breadcrumb">
                            <li ><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            {{--                        <li class="breadcrumb-item active">Pos Management</li>--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <!-- search -->

                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('admin.incentive.flat.create')}}" class="btn btn-primary">Create Incentive</a>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Range</th>
                                                        <th>Threshold</th>
                                                        <th>Description</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
                                                    </tr>

                                                    </thead>
                                                    @foreach($datas as $data)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$data->range_set}}</td>
                                                        <td>{{$data->threshold}}</td>
                                                        <td>{{$data->description}}</td>
                                                        <td>{{$data->created_at}}</td>
                                                        <td>
                                                            <a  href="{{route('admin.view.agent',$data->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                            <a  href="{{route('admin.incentive.flat.delete',$data->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
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

