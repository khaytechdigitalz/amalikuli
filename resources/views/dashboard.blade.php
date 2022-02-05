@extends("layouts.sidebar")

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
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

                <div class="col-xl-4 col-sm-6 col-12">

               


                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-wallet"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Wallet Balance</div>
                                    <div class="dash-counts">
                                        <p>₦{{$wallet}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
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
                                    <div class="dash-title">Total Agents</div>
                                    <div class="dash-counts">
                                        <p>{{$agent}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75"
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
                                    <div class="dash-title">Transactions</div>
                                    <div class="dash-counts">
                                        <p>{{$trans_count}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            {{--                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>--}}
                        </div>
                    </div>
                </div>
{{--            <div class="col-xl-3 col-sm-6 col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="dash-widget-header">--}}
{{--<span class="dash-widget-icon bg-4">--}}
{{--<i class="far fa-file"></i>--}}
{{--</span>--}}
{{--                            <div class="dash-count">--}}
{{--                                <div class="dash-title">Estimates</div>--}}
{{--                                <div class="dash-counts">--}}
{{--                                    <p>2,150</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress progress-sm mt-3">--}}
{{--                            <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            </div>
            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <h5 class="text-secondary">Recent 10 Transactions</h5>
                        <!-- search -->
                         
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-center table-hover datatable">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Agent Code</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trans as $tran)
                                                    <tr>
                                                        <td>
                                                            {{$i++}}
                                                        </td>

                                                        <td>
                                                            {{$tran->sub_agent}}
                                                        </td>

                                                        <td>
                                                            {{$tran->amount}}
                                                        </td>

                                                        <td>
                                                            {{$tran->remark}}
                                                        </td>

                                                        <td>
                                                            {{$tran->status}}
                                                        </td>

                                                        <td>
                                                            {{$tran->created_at}}
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
@endsection
