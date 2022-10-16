@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Performance Report</h3>

                    </div>
                </div>
            </div>


            <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Perfomance Report</li>
                                </ul>

            <div class="card-body">
                <form class="form" id="filter_form" method="get">
                    <div class="row">
                        <!-- search -->

                        <div class="card">


                            <div class="card-body">
                                <form method="POST" action="{{route('agent.performanceSearch')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <select name="month" class="form-select">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select name="year" class="form-select">
                                                @php
                                                    $current=date('Y');
                                                    $loop=10;
                                                @endphp

                                                @for($i=0; $i < $loop; $i++)
                                                    <option value="{{$current-$i}}">{{$current-$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="text-success"></label>
                                            <input type="submit" class="btn btn-secondary" value="Fetch" name="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Agent Name</th>
                                                        <th>Agent Phone Number</th>
                                                        <th>Transaction Volume</th>
                                                        <th>Transaction Count</th>
                                                        <th>Total Amount</th>
                                                        <th>Total Count</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{$user->firstname}} {{$user->lastname}}</td>
                                                            <td>{{$user->phone}}</td>
                                                            <td>{{\App\Models\Transaction::where([['user_id', $user->id], []])->sum('amount')}}</td>
                                                            <td>{{\App\Models\Transaction::where('user_id', $user->id)->count()}}</td>
                                                            <td>{{\App\Models\Transaction::where('user_id', $user->id)->sum('amount')}}</td>
                                                            <td>{{\App\Models\Transaction::where('user_id', $user->id)->count()}}</td>
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

