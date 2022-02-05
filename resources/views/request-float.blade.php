@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Request Float</h3>
                                 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                     <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


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

                                    <form action="" method="POST">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Enter Amount</label>
                                                    <input name="amount" type="number" class="form-control" required>
                                                </div>
                                              
                                            </div>
                                             
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select Duration (Days)</label>
                                                    <select name="duration" class="form-control">
                                                    <option value="1">1 Day</option>
                                                    <option value="2">2 Days</option> 
                                                    <option value="3">3 Days</option> 
                                                    <option value="4">4 Days</option> 
                                                    <option value="5">5 Days</option> 
                                                    <option value="6">6 Days</option> 
                                                    <option value="7">7 Days</option> 
                                                    <option value="8">8 Days</option> 
                                                    <option value="9">9 Days</option> 
                                                    <option value="10">10 Days</option> 
                                                    </select>
                                                </div>
                                              
                                            </div>
                                             

                                            <table>
  <tr> 
    <th>#</th>
    <th>Details</th>
  </tr>
  <tr> 
    <td>Minimum Float</td>
    <td>{{$general->cur_sym}} {{$general->float_min_amount}}</td>
  </tr>
  
  <tr> 
    <td>Maximum Float</td>
    <td>{{$general->cur_sym}} {{$general->float_max_amount}}</td>
  </tr>

  <tr> 
    <td>Minimum Duration</td>
    <td>{{$general->float_min_tenure}} Days</td>
  </tr>
  <tr> 
    <td>Maximum Duration</td>
    <td>{{$general->float_max_tenure}} Days</td>
  </tr>
  
  
   
</table>


                                            </div>
                                            <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary">Request Float</button>
                                        </div>
                                        </div>
                                        
                                    </form>
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
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
@endsection

