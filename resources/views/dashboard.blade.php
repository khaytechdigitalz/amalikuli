@extends("layouts.sidebar")

@section('content')
@push('styles')
<link rel="stylesheet" href=" https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">


            <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ul>
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
                                    <div class="dash-title">Total Customer</div>
                                    <div class="dash-counts">
                                        <p>{{$customer}}</p>
                                    </div>
                                </div>
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
                                    <div class="dash-title">Transactions</div>
                                    <div class="dash-counts">
                                        <p>{{$trans_count}}</p>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>

                   @if(canSee('agents'))
<div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fa fa-sitemap"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Agents</div>
                                    <div class="dash-counts">
                                        <p>{{$agent}}</p>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>


<div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fa fa-fax"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Terminals</div>
                                    <div class="dash-counts">
                                        <p>{{$terminals}}</p>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>


<div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
<span class="dash-widget-icon bg-info">
<i class="fa fa-gift"></i>
</span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Float <small>(Sub Agents)</small></div>
                                    <div class="dash-counts">
                                        <p>{{$agentfloat}}</p>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>

                    @endif
            </div>


            <div class="col-xl-12 col-sm-12 col-12">

<div id="columnchart_material" style="width: 100%; height: 500px;"></div>

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
                    <br>
                    <br>
                    <br> <br>
                    <hr>
                         </div>
                                             <table id="example"  class="table table-center table-hover">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>S/N</th>
                                                    @if(canSee('agents'))
                                                    <th>Agent Code</th>
                                                    @endif
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
                                                    @if(canSee('agents'))

                                                    <td>{{$data->uuid}}</td>
                                                    @endif
                                                    <td>{{$data->type}}</td>
                                                    <td>₦{{number_format($data->amount,2)}}</td>
                                                    <td>{{$data->remark}}</td>
                                                    <td>
                                                    @if($data->status == 1)
                                                    <badge class="badge bg-success">Successful</badge>
                                                    @else
                                                    <badge class="badge bg-danger">Not Successful</badge>
                                                    @endif
                                                    </td>
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


@endpush
