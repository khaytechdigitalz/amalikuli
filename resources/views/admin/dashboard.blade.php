@extends("admin.layout.sidebar")
@section('content')
@push('styles')
<link rel="stylesheet" href=" https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
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
                                    <div class="dash-title">All Wallet Balance</div>
                                    <div class="dash-counts">
                                        <p>₦{{number_format($balance,2)}}</p>
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
                                        <p>{{$trx}}</p>
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
                          <div class="col-xl-12 col-sm-12 col-12">

                          <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

                           </div>
            </div>
            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">


                        <h5 class="text-secondary">Recent Transactions</h5>
                        <!-- search -->

                                <div class="card card-table">

                                    <div class="card-body">

                    <div class="table-responsive">
                    <br>
                    <h6>Filter Transaction</h6>
                    <div class="row">

                        <div class="col-xl-3 col-sm-6 col-12">
                            <label for="search"> From Date </label>
                            <div class="input-group">
                                <input type="date" name="from" class="form-control" placeholder="search...">

                            </div>
                        </div>


                        <div class="col-xl-3 col-sm-6 col-12">
                            <label for="search"> To Date </label>
                            <div class="input-group">
                                <input type="date" name="to" class="form-control"  placeholder="search...">

                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12">
                        <label for="search"> Type </label>
                        <div class="input-group">
                           <select name="type" class="form-control">
                           <option value="Credit">Credit</option>
                           <option value="Debit">Debit</option>
                           <option value="Bills">Bills</option>
                           <option value="Airtime">Airtime</option>
                           <option value="Cable TV">Cable TV</option>
                           <option value="Internet Data">Internet Data</option>
                           </select>

                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                       <br>
                        <div class="input-group">
                        <button type="submit" class="btn btn-primary btn-sm">Filter Transaction</button>


                        </div>
                    </div>
                    <hr>
                         </div>
                                             <table id="example"  class="table table-center table-hover datatable">
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
                                                @foreach($trans as $data)
                                                <tr>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->uuid}}</td>
                                                    <td>{{$data->type}}</td>
                                                    <td>₦{{number_format($data->amount,2)}}</td>
                                                    <td>{{$data->remark}}</td>
                                                    <td>{{$data->status}}</td>
                                                    <td>{{$data->created_at}}</td>
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
@push('script')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Credit', 'Debit'],
          ['Jan', {{$cjan}}, {{$djan}}],
          ['Feb', {{$cfeb}}, {{$dfeb}}],
          ['Mar', {{$cmar}}, {{$dmar}}],
          ['Apr', {{$capr}}, {{$dapr}}],
          ['May', {{$cmay}}, {{$dmay}}],
          ['Jun', {{$cjun}}, {{$djun}}],
          ['Jul', {{$cjul}}, {{$djul}}],
          ['Aug', {{$caug}}, {{$daug}}],
          ['Sep', {{$csep}}, {{$dsep}}],
          ['Oct', {{$coct}}, {{$doct}}],
          ['Nov', {{$cnov}}, {{$dnov}}],
          ['Dec', {{$cdec}}, {{$ddec}}],
        ]);

        var options = {
          chart: {
            title: 'Credit & Debit Performance',
            subtitle: 'Sales, Expenses, and Profit: {{date('Y')}}',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

@endpush

@section('scripts')

    <script src="{{asset('assets/js/script.js')}}"></script>

@endsection
