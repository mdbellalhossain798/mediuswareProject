@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Diposit') }}</div>

                <div class="card-body">

                    <table width="100%" border="1">
                        <tr>
                            <td>SL.</td>
                            <td>Trn. id</td>
                            <td class="text-right">Amount</td>
                            <td>Date</td>
                        </tr>
                        @if(!empty($transaction_balances))
                       @php 
                            $current_balance=0;
                       @endphp
                        @foreach($transaction_balances->transactions as $value)
                         
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$value->id}}</td>                           
                            <td class="text-right">{{number_format($value->amount,3)}}</td>
                            <td>{{$value->created_at !="" ? date('d/m/Y',strtotime($value->created_at)) :''}}</td>
                        </tr>
                       {{$current_balance +=$value->amount  }} 
                        @endforeach
                        @endif
                        <tr>
                           
                            <td colspan="2" class="text-right"> <strong> Total Diposit  = </strong> </td>
                            <td class="text-right">{{number_format( $current_balance ,3)}}</td>
                            <td ></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection