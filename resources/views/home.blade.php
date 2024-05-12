@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction & Current Balance') }}</div>

                <div class="card-body">

                    <table width="100%" border="1">
                        <tr>
                            <td>SL.</td>
                            <td>Trn. id</td>
                            <td>Trn. Type</td>
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
                            @php $bg_color= $value->amount < 0 ? 'background-color:yellow' :''; @endphp
                        <tr style="<?=  $bg_color ?>">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->transactions_type}}</td>
                            <td class="text-right">{{number_format($value->amount,3)}}</td>
                            <td class="text-right">{{number_format($value->fee,3)}}</td>
                            <td class="text-right" >{{number_format(abs($value->amount) +$value->fee ,3)}}</td>
                            <td>{{$value->created_at !="" ? date('d/m/Y',strtotime($value->created_at)) :''}}</td>
                        </tr>
                        @if($value->transactions_type =="DIPOSIT")
                        @php
                        $current_balance +=$value->amount +$value->fee
                        @endphp
                        @else
                        @php
                        $current_balance -=abs($value->amount) +$value->fee
                        @endphp

                        @endif

                        @endforeach
                        @endif
                        <tr>

                            <td colspan="5" class="text-right"> <strong> Current Balance = </strong> </td>
                            <td class="text-right">{{number_format( $current_balance ,3)}}</td>
                            <td></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection