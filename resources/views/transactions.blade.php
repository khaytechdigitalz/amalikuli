@extends('layouts.sidebar')

@push('styles')
<link rel="stylesheet" href=" https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Transactions</h3>

                    </div>
                </div>
            </div>

            <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Transactions</li>
                                </ul>

            <div class="rowg">
                <div class="col-sm-12">
                <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">


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
                                                @foreach($datas as $data)
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
@endpush
@section('scripts')
    <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
