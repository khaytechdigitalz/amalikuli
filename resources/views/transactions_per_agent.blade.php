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
                        <h3 class="page-title">Sub-Agent Transaction</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agents')}}">Agents</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-wallet"></i>
</span>
                                        <div class="dash-count">
                                            <div class="dash-title">Daily Transaction Amount</div>
                                            <div class="dash-counts">
                                                <p>₦{{$tran_sum}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-5" role="progressbar" style="width: 75%"
                                             aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    {{--                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>1.15%</span> since last week</p>--}}
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
                                            <div class="dash-title">Daily Transaction Count</div>
                                            <div class="dash-counts">
                                                <p>{{$tran_count}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-6" role="progressbar" style="width: 65%"
                                             aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    {{--                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p>--}}
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
                                            <div class="dash-title">Agent Wallet Balance</div>
                                            <div class="dash-counts">
                                                <p>₦{{$wallet->balance}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-7" role="progressbar" style="width: 85%"
                                             aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    {{--                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>--}}
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
                                        <th>Transaction Reference</th>
                                        <th>Type</th>
                                        <th>Remark</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        {{--                                    <th class="text-right">Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>
                                                {{$data->reference}}
                                            </td>
                                            <td>
                                                {{$data->type}}
                                            </td>
                                            <td>
                                                {{$data->remark}}
                                            </td>
                                            <td>
                                                {{$data->amount}}
                                            </td>
                                            <td>
                                                @if($data->status == 1)
                                                    <span class="badge badge-primary"> Successful </span>
                                                @else
                                                    <span class="badge badge-danger"> Failed</span>
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
