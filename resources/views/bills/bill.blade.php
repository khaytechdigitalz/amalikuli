@extends('layouts.sidebar')
@section('content')

    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }h2 {
             color: #fa0334;
             font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
             font-weight: 900;
             font-size: 40px;
             margin-bottom: 10px;
         }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
        }
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left:-15px;
        } f {
              color: #fa0334;
              font-size: 100px;
              line-height: 200px;
              margin-left:-15px;
          }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>
    <body>
    <div class='card mt-5'>
     <div class='card-body'>
        @if($rep = 'success')
            <div style='border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;'>
                <i class='checkmark'>✓</i>
            </div>
            <h1>Success</h1>
        @elseif($rep != 'success')
            <div style='border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;'>
                <span class='checkmark'>x</span>
            </div>
            <h2>Fail</h2>
        @endif

            <p>{{$am}}<br/> Thanks</p>
            <a href='{{route('dashboard')}}'><button type='button' class='btn btn-outline-success'>Continue</button></a>
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
