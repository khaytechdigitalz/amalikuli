@extends("admin.layout.sidebar")
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-wallet"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Agent Balance</div>
                                    <div class="dash-counts">
                                        <p>₦{{number_format($agent->balance,2)}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-2">
<i class="fas fa-users"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Sub Agents</div>
                                    <div class="dash-counts">
                                        <p>{{$subagent}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-file-alt"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Terminals</div>
                                    <div class="dash-counts">
                                        <p>{{count($terminals)}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                 
            </div>
            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <h5 class="text-secondary">Subagents</h5>
                         

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Agent Code</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subagents as $user)
                                        <tr>
                                            <td>
                                                {{$user->uuid."-".$user->id}}
                                            </td>
                                            <td>
                                                {{$user->firstname}}
                                            </td>
                                            <td>
                                                {{$user->lastname}}
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
                                                <a href="{{route('admin.subagentTransactions',$user->id)}}"
                                                   class="btn btn-primary btn-sm">View Account</a>
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



            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <h5 class="text-secondary">Terminals</h5>

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
                        <br>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                        Add Agent Terminal
                        </button>

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
                                                {{@App\Models\User::whereId($data->agent_id)->first()->firstname}} 
                                                {{@App\Models\User::whereId($data->agent_id)->first()->lastname}}
                                            </td>
                                            <td>

                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->firstname}} 
                                            {{@App\Models\User::whereId($data->sub_agent_id)->first()->lastname}}
                                                 
                                            </td>
                                            <td>
                                                {{$data->serial_number}}
                                            </td>
                                            <td>
                                               @if($data->status == 1)
                                                    <span class="badge badge-primary"> Active </span>
                                                @else
                                                    <span class="badge badge-danger"> De-activated </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->created_at}}
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


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Terminal To Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <form method="post" action="{{route('admin.addterminal',$agent->id)}}">
    {{ csrf_field() }}

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label class="label-text">Serial Number</label>
        <input class="form-control" name="serialnumber" placeholder="Enter Serial Number">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create</button>
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
