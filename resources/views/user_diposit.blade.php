@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Withdrawal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('diposit-save') }}">
                        @csrf                       
                        <div class="form-group row">
                            <label for="trn_type" class="col-md-4 col-form-label text-md-right">{{ __('Trn. type') }}</label>

                            <div class="col-md-6">
                                <select name="trn_type" id="trn_type" class="form-control" required>
                                    <option value="DIPOSIT" selected>DIPOSIT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input type="number" name="amount" id="amount" class="form-control" value="" required>

                            </div>
                        </div>                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('DIPOSIT') }}
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
    
</script>
@endpush