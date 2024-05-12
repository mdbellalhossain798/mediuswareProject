@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Withdrawal') }}</div>

                <div class="card-body">

                    <table width="100%" border="1">
                        <tr>
                            <td>SL.</td>
                            <td>Trn. id</td>
                            <td class="text-right">Amount</td>
                            <td class="text-right">fee</td>
                            <td class="text-right">Total Amt.</td>
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
                            <td class="text-right">{{number_format(abs($value->amount),3)}}</td>
                            <td class="text-right">{{number_format($value->fee,3)}}</td>
                            <td class="text-right">{{number_format(abs($value->amount) +$value->fee ,3)}}</td>
                            <td>{{$value->created_at !="" ? date('d/m/Y',strtotime($value->created_at)) :''}}</td>
                        </tr>
                       @php $current_balance +=abs($value->amount) +$value->fee @endphp
                        @endforeach
                        @endif
                        <tr>
                           
                            <td colspan="4" class="text-right"> <strong> Total Withdrawal = </strong> </td>
                            <td class="text-right">{{number_format( abs($current_balance) ,3)}}</td>
                            <td ></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection