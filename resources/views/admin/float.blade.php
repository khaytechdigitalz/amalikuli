@extends("admin.layout.sidebar")

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{$title}}</h3>
                        <ul class="breadcrumb">

                        </ul>
                    </div>
                    <div class="row">

                    <div class="col-xl-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-spinner"></i>
</span>
                                        <div class="dash-count">
                                            <div class="dash-title">Pending Loan</div>
                                            <div class="dash-counts">
                                                <p>{{$pending}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-1" role="progressbar" style="width: 100%"
                                             aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-danger">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Active Loan</div>
                                            <div class="dash-counts">
                                                <p>{{$running}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                             aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th>Transaction Reference</th>
                                        <th>Amount</th>
                                        <th>Interest</th>
                                        <th>Expected Payment</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Due Date</th>
                                      <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loan as $data)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$data->reference}}
                                            </td>
                                            <td>
                                            ₦{{$data->amount}}
                                            </td>
                                            <td>
                                            ₦{{$data->interest}}
                                            </td>
                                            <td>
                                            ₦{{$data->total}}
                                            @if($data->paid > 0)
                                            <br>
                                            <p class="badge badge-ligh text-success">
                                            Total Paid: ₦{{$data->paid}}
                                            </p>
                                            @endif
                                            </td>
                                            <td>
                                            {{$data->duration}} Days
                                            </td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="badge badge-warning"> Pending </span>
                                                @elseif($data->status == 1)
                                                    @if($data->expire < $now)
                                                     <span class="badge badge-danger"> Due Loan
                                                     </span>
                                                     @else
                                                      <span class="badge badge-danger"> Running </span>
                                                     @endif
                                                @elseif($data->status == 2)
                                                    <span class="badge badge-success"> Closed </span>
                                                @else
                                                    <span class="badge badge-danger"> Failed</span>
                                                @endif
                                            </td>
                                            <td>
                                            {!! date(' D, d M, Y', strtotime($data->created_at)) !!}
                                            </td>
                                            <td>
                                            {!! date(' D, d M, Y', strtotime($data->expire)) !!}<br>
                                           <b> {{ Carbon\Carbon::parse($data->expire)->diffForHumans() }}</b>
                                            </td>
                                            <td>
                                            <a href="{{url('admin/float')}}/{{$data->id}}" class="btn btn-sm btn-primary text-white" href="">View Loan</a>
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
