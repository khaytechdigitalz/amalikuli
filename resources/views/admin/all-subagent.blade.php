@extends('admin/layout.sidebar')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Sub-Agents</h3>
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
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th >#</th>
                                        <th>Super Agent</th>
                                        <th>Agent Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                           <td>{{$loop->iteration}}</td>
                                            <td>
                                                
                                                @php
                                                $agent = App\Models\User::whereUuid($user->uuid)->whereSubAgent(null)->first();
                                                @endphp
                                                @if($agent)
                                                {{$agent->email}}<br>
                                                <a  href="{{route('admin.view.agent',$agent->id)}}" class="btn btn-sm btn-primary">View Super Agent</a>
                                                @endif
                                            </td>
                                            <td>
                                                {{$user->uuid."-".$user->id}}<br>
                                                 
                                            </td>
                                            <td>
                                                {{$user->firstname}} {{$user->lastname}}
                                            </td>
                                            
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phone}}
                                            </td>
                                            <td>
                                            ₦ {{$user->wallets[0]->balance}}
                                            </td>
                                            <td>
                                                @if($user->status == 1)
                                                    <span class="badge badge-primary"> Active </span>
                                                @else
                                                    <span class="badge badge-danger"> De-activated </span>
                                                @endif
                                            </td>
                                            <td>
                                            <a  href="{{route('admin.view.agent',$user->id)}}" class="btn btn-sm btn-primary">View Perfomance</a>
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

