@extends("admin.layout.sidebar")
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-lock"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Verified<b> ( {{$verified}} )</b></div>
                                     
                                </div>
                                <br>
                                <a href="{{route('admin.kycs.successful')}}" class="btn btn-primary btn-sm"> View</a>
                            </div> 
                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-unlock"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Unverifed<b> ( {{$unverified}} )</b></div>
                                </div><br>
                                <a href="{{route('admin.kycs.rejected')}}" class="btn btn-primary btn-sm">View </a>
                            </div> 
                           
                        </div>
                    </div>
                </div>
                 
            </div>
             



            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <h5 class="text-secondary">{{$title}}</h5>

                        <div class="row">
                            <div class="col-sm-12">
                        <br>
                        

                        <hr>
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>SN</th>
                                        <th>Agent</th>  
                                        <th>Status</th>
                                        <th>Date</th> 
                                        <th>Action</th> 
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all as $data)
                                    @php
                                    $user = App\Models\User::whereId($data->user_id)->first();
                                    @endphp

                                        <tr>
                                            <td>
                                            {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{$user->firstname ?? ""}}
                                                {{$user->lastname ?? ""}}<br>
                                                <small>{{$user->email ?? ""}}</small>
                                            </td>  
                                            <td>
                                               @if($data->status == 1)
                                                    <span class="badge badge-primary"> Verified </span>
                                                @else
                                                    <span class="badge badge-danger"> Pending </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->created_at}}
                                            </td> 
                                            <td>
                                            <a href="{{route('admin.viewkyc',$data->id)}}" class="btn btn-primary btn-sm"> 
                                             View
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
