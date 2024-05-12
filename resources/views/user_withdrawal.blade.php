@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Withdrawal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('withdrawal-save') }}">
                        @csrf
                        <input type="hidden" name="account_type" id="account_type" value="{{Auth::user()->account_type}}">
                        <input type="hidden" name="withdrawal_amount_thisMonth" id="withdrawal_amount_thisMonth" value="{{$sumWithdrawal}}">
                        <input type="hidden" name="currentBalance" id="currentBalance" value="{{$currentBalance}}">
                        <div class="form-group row">
                            <label for="trn_type" class="col-md-4 col-form-label text-md-right">{{ __('Trn. type') }}</label>

                            <div class="col-md-6">
                                <select name="trn_type" id="trn_type" class="form-control" required>
                                    <option value="WITHDRAWAL" selected>WITHDRAWAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input type="number" name="amount" id="amount" class="form-control" value="" onkeyup="enterAmount(this)" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="fee" id="fee" class="form-control" value="" readonly>

                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js_right')
<script>
    function enterAmount(element) {
        var amount = $(element).val();
        var fee = 0;
        var account_type = $('#account_type').val();
        var withdrawal_amount_thisMonth = Math.abs($('#withdrawal_amount_thisMonth').val());
        var current_balance=$('#currentBalance').val();
        const currentDate = new Date();
        const dayOfWeek = currentDate.getDay();
        const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const dayName = dayNames[dayOfWeek];
        var individual_after_1k_charge = amount > 1000 ? ((amount - 1000) / 100) * 0.015 : 0;
        var individual_each_month_after_5k_charge = withdrawal_amount_thisMonth > 5000 ? (withdrawal_amount_thisMonth / 100) * 0.015 : 0;
        console.log(current_balance , amount);

        if (parseFloat(current_balance) < parseFloat(amount) ) {
            alert("You Current Balance is Low");
            $(element).val('');
            $('#fee').val('');
            return false;
        }
        if (account_type == "INDIVIDUAL") {
            if (dayName == "Friday" && amount <= 1000 && withdrawal_amount_thisMonth <= 5000) {
                fee = 0;
            } else {
                if (amount > 1000 && withdrawal_amount_thisMonth <= 5000) {
                    fee = ((amount - 1000) / 100) * 0.015;
                    console.log(fee + '_fee');
                } else if (withdrawal_amount_thisMonth > 5000) {
                    fee = (amount / 100) * 0.015;
                    console.log(fee + '_fee2');
                }
            }
            $('#fee').val(fee.toFixed(3));

        }
        var business_fee_50k=0;
        var business_fee=0;
        if (account_type == "BUSINESS" ) {
            if ( amount <= 50000) {
                business_fee_50k = (amount / 100) * 0.025;
            }else{
                business_fee = (amount / 100) * 0.015;
            }
            console.log(business_fee_50k, business_fee, business_fee_50k+business_fee);
            $('#fee').val(parseFloat(business_fee_50k+business_fee).toFixed(3));

        }
    }
</script>
@endpush