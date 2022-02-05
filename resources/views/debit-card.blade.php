@extends('layouts.sidebar')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-10">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Debit Card</h3>
                                <ul class="breadcrumb">
                                    <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @include('error_success_message')

                        <div class="col-xl-12 col-md-12">

                            <div class="card card-table">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">Debit-Cards</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm"
                                               data-bs-toggle="modal" data-bs-target="#add_tax">Request For
                                                Debit-Card</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Account Number</th>
                                                <th>Account Name</th>
                                                <th>Address</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cards as $card)
                                                <tr>
                                                    <td>
                                                        {{$card->account_number}}
                                                    </td>

                                                    <td>
                                                        {{$card->account_name}}
                                                    </td>

                                                    <td>
                                                        {{$card->address}}
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

                    <div id="add_tax" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Request For Debit-Card</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('verifyDebitcard')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="accountNumber">Account Number <span class="text-danger">*</span></label>
                                            <input id="accountNumber" class="form-control" type="text"
                                                   name="accountNumber" value="{{old('accountNumber')}}">
                                        </div>
                                        {{--                    <div class="form-group">--}}
                                        {{--                        <label>Card Type<span class="text-danger">*</span></label>--}}
                                        {{--                        <select class="form-control" type="text">--}}
                                        {{--                            <option>Verve</option>--}}
                                        {{--                            <option>Master</option>--}}
                                        {{--                        </select>--}}
                                        {{--                    </div>--}}
                                        {{--                    <div class="form-group">--}}
                                        {{--                        <label>Status <span class="text-danger">*</span></label>--}}
                                        {{--                        <select class="select">--}}
                                        {{--                            <option>Pending</option>--}}
                                        {{--                            <option>Approved</option>--}}
                                        {{--                        </select>--}}
                                        {{--                    </div>--}}
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="edit_tax" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Tax Name <span class="text-danger">*</span></label>
                        <input class="form-control" value="VAT" type="text">
                    </div>
                    <div class="form-group">
                        <label>Tax Percentage (%) <span class="text-danger">*</span></label>
                        <input class="form-control" value="14%" type="text">
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="select">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal custom-modal fade" id="delete_tax" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-icon text-center mb-3">
                    <i class="fas fa-trash-alt text-danger"></i>
                </div>
                <div class="modal-text text-center">
                    <h2>Delete Tax</h2>
                    <p>Are you sure want to delete?</p>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Delete</button>
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

