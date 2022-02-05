@extends('admin/layout.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">All Agents</h3>
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

{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <form method="POST">--}}
{{--                                    <label class="text-success">From: </label> <input type="date" class="text-success"  name="from">--}}
{{--                                    <label class="text-success" >To: </label> <input type="date" class="text-success" name="to">--}}
{{--                                    <input type="submit" class="text-success" value="Filter" name="submit">--}}
{{--                                </form>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Agent Code</th>
                                                        <th>Name</th>
                                                        <th>Terminals</th>
                                                        <th>Business Phone</th>
                                                        <th>Email</th>
                                                        <th>Date Registered</th>
                                                        <th>Action</th>
                                                    </tr>
                                                   
                                                    </thead>
                                                    @foreach($agents as $data)
                                                    @php
                                                    $i = 1;
                                                    $terminal = App\Models\Terminal::whereAgentId($data->id)->count();
                                                    @endphp
                                                    <tr> 
                                                        <td>{{$data->uuid}}</td>
                                                        <td>{{$data->firstname. " " .$data->lastname}}</td>
                                                        <td>{{$terminal}}</td>
                                                        <td>{{$data->phone}}</td>
                                                        <td>{{$data->email}}</td>
                                                        <td>{{$data->created_at}}</td>
                                                        <td><a  href="{{route('admin.view.agent',$data->id)}}" class="btn btn-sm btn-primary">View</a></td>
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

