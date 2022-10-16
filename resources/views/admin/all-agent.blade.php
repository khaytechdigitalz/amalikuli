@extends('admin/layout.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">

                    <div class="col">
                        <h3 class="page-title">Master Agents</h3>
                        <ul class="breadcrumb">
                            <li ><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            {{--                        <li class="breadcrumb-item active">Pos Management</li>--}}
                        </ul>
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

                            @if (session('status'))
                                    <div class="card-body">
                                        <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
                                            {{ session('status') }}
                                        </div>
                                    </div>
                                    @endif

                                    @if (session('error'))
                                    <div class="card-body">
                                        <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                    @endif

                                    @if (session('success'))
                                    <div class="card-body">
                                        <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                    @endif
                                    <br>

                                <div class="col-sm-12">

                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                                Assign Terminal
                                </button>

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


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Terminal To Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <form method="post" action="{{route('admin.assignterminal')}}">
    {{ csrf_field() }}

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label class="label-text">Select Agent</label>
        <select name="agent" class="form-control">
        <option selected disabled>Please Select Master Agent</option>
        @foreach($agents as $data)
        <option value="{{$data->id}}">{{$data->firstname}} {{$data->lastname}}</option>
        @endforeach
        </select>
         </div>


        <div class="form-group">
        <label class="label-text">Serial Number</label>
        <input class="form-control" name="serialnumber" placeholder="Enter Serial Number">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Assign Terminal</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection

