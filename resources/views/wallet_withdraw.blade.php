@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Withdraw</h3>
                            </div>
                        </div>
                    </div>

                                 <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Withdraw</li>
                                </ul>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    {{--                                <h4 class="card-title">Basic Info</h4>--}}
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

                                    <form action="{{route('createSubAgent')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank</label>
                                                    <select name="bank" class="form-select">
                                                        <option>GTBank</option>
                                                        <option>Wema</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input name="account_number" type="text" class="form-control"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Name</label>
                                                    <input name="account_name" type="text" class="form-control" readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" name="amount" id="amount" class="form-control"
                                                           placeholder="Enter amount" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="amount">Transfer Note</label>
                                                    <textarea name="note" class="form-control"
                                                              placeholder="Enter tranfer note">Transfer from Amali</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary">Withdraw</button>
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

