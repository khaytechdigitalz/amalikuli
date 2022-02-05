@extends("admin.layout.sidebar")
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-calculator"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Terminals <b> ( {{$total}} )</b></div>
                                    <a href="{{url('admin/posmanagement')}}" class="btn btn-sm btn-primary">View Terminal</a>
                                     
                                </div>
                            </div> 
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-2">
<i class="fas fa-calculator"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Assigned<b> ( {{$assigned}} )</b></div>
                                    <a href="{{url('admin/assigned-terminal')}}" class="btn btn-sm btn-primary">View Terminal</a>
                                </div>
                            </div> 
                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-calculator"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Unassigned<b> ( {{$unassigned}} )</b></div>
                                    <a href="{{url('admin/unassigned-terminal')}}" class="btn btn-sm btn-primary">View Terminal</a>
                                </div>
                            </div> 
                           
                        </div>
                    </div>
                </div>
                 
            </div>
             

                                   

            <div class="card-body">
                    <div class="row">
                        <h5 class="text-secondary">{{$title}}</h5>

                        <div class="row">
                            <div class="col-sm-12">
                           
                            <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Create New Terminal</a>

                        <br>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create New Terminal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST">
      @csrf
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label>Enter Terminal ID</label>
        <input class="form-control" name="terminalid">
      </div>

      <div class="form-group">
        <label>Enter Serial Number</label>
        <input class="form-control" name="serialnumber">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>

    </div>
  </div>
</div>
<!-- END MODAL-->

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

                        

                        <hr>
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>SN</th>
                                        <th>Terminal ID</th>
                                        <th>Agent Assigned</th>
                                        <th>Sub Agent Assigned</th>
                                        <th>Serial Number</th>
                                        <th>Status</th>
                                        <th>Date</th> 
                                        <th>Status</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($terminals as $data)
                                        <tr>
                                            <td>
                                            {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{$data->terminal_id}}
                                            </td>
                                            <td>
                                            <a  href="{{route('admin.view.agent',@App\Models\User::whereId($data->agent_id)->first()->id ?? 0)}}">
                                                {{@App\Models\User::whereId($data->agent_id)->first()->firstname ?? "Not Assigned"}} 
                                                {{@App\Models\User::whereId($data->agent_id)->first()->lastname ?? ""}}
                                            </a>
                                            </td>
                                            <td>

                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->firstname ?? "Not Assigned"}} 
                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->lastname ?? ""}}
                                            </td>
                                            <td>
                                                {{$data->serial_number}}
                                            </td>
                                            <td>
                                               @if($data->status == 1)
                                                    <span class="badge badge-primary"> Active </span>
                                                @else
                                                    <span class="badge badge-danger"> Inactive </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->created_at}}
                                            </td> 
                                            <td>
                                            <a href="{{route('admin.posterminal',$data->id)}}" class="label label-primary"> 
                                            @if($data->status == 1)
                                            Deactivate
                                            @else
                                            Activate
                                            @endif
                                            </a>
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
