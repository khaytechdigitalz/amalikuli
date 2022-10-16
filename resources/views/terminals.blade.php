@extends('layouts.sidebar')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Terminals</h3>
                        <
                    </div>
                </div>
            </div>
            <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Terminals</li>
                                </ul>


            <div class="row">
                <div class="col-sm-12">
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


                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>SN</th>
                                        <th>Terminal ID</th>
                                        <th>Serial Number</th>
                                        <th>Sub Agent Assigned</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>
                                                {{$i++}}
                                            </td>
                                            <td>
                                                {{$data->terminal_id}}
                                            </td>
                                            <td>
                                                {{$data->serial_number}}
                                            </td>
                                            <td>
                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->firstname ?? "Not Assigned"}}
                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->lastname ?? "Not Assigned"}}

                                            </td>
                                            <td>
                                                @if($data->status == 1)
                                                    <span class="badge badge-primary"> Active </span>
                                                @else
                                                    <span class="badge badge-danger"> Not Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->created_at}}
                                            </td>
                                            <td class="text-right ">
                                                <button  data-toggle="modal" data-target="#myModal{{$data->id}}" class="btn btn-sm btn-primary">Assign</button>
                                                @if($data->status == 1)
                                                    <a class="btn btn-primary" href="{{route('terminalsTransaction', $data->id)}}">View Transactions</a>
                                                @endif
                                            </td>
                                        </tr>


<!-- The Modal -->
<div class="modal" id="myModal{{$data->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Assign Terminal</h4><br>
      </div>

      <br>

      <div class="modal-header">
      <a class="text-danger">
        Please ensure you check very well before assigning Terminal to a sub agent. We will not be liable to any loss arising from you assigning Terminal to a wrong sub agent
        </a>
      </div>
      <form action="" method="POST">
      @csrf
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label>Select Sub Agent</label>
        <select  name="agent" class="form-control">
        <option  select disabled>Please Select A Sub Agent</option>
        @foreach($subagent as $datas)
        <option value="{{$datas->id}}">{{$datas->firstname}} {{$datas->lastname}}</option>
        @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Serial Number</label>
        <input name="serialnumber" value="{{$data->serial_number}}" readonly class="form-control" >
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign</button>
      </div>
    </form>

    </div>
  </div>
</div>
<!-- END MODAL-->

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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
