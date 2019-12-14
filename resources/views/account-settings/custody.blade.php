@extends('account-settings.custody-template')
@section('title', $title)

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Custody Accounts</h5>
    </div>
    <div class="card-content">
        <div class="card">
            <div class="row">
            	<div class="col-xs-12 col-sm-1">TOKEN SYMBOL</div>
            	<div class="col-xs-12 col-sm-1">COUNT OF TOKENS</div>
            	<div class="col-xs-12 col-sm-2">CURRENT BUDGET</div>
            	<div class="col-xs-12 col-sm-2">BALANCE</div>
            	<div class="col-xs-12 col-sm-2">UPDATED AT</div>
            	<div class="col-xs-12 col-sm-2">ADD BUDGET</div>
            	<div class="col-xs-12 col-sm-2">ACTION</div>
            </div>
            <div class="card-content">
                @foreach ($accounts as $account)
                	<form action="{{ URL('/account-settings/deposit-funds/'.$account->account_id) }}" method="post" class="row margin-top-1">
                		@csrf
	                    <div class="col-xs-12 col-sm-1">
	                        <input type="text" name="tokenSymbol" value="{{ $account->token_symbol }}"/>
	                    </div>
	                    <div class="col-xs-12 col-sm-1">
	                    	<input type="text" name="tokenCount" value="{{ $account->token_count }}"/>
	                    </div>
	                    <div class="col-xs-12 col-sm-2">
	                    	<input type="text" value="{{ $account->total_budget }}" disabled/>
	                    </div>
	                    <div class="col-xs-12 col-sm-2">
	                    	<input type="text" value="{{ $account->token_balance }}" disabled/>
	                    </div>
	                    <div class="col-xs-12 col-sm-2">
	                    	<input type="text" value="{{ $account->updated_at }}" disabled/>
	                    </div>
	                    <div class="col-xs-12 col-sm-2">
	                    	<input type="number" name="unit"/>
	                    </div>
	                    <div class="col-xs-12 col-sm-2">
	                    	<button>DEPOSIT</button>
	                	</div>
	                </form>
                @endforeach
        	</div>
    	</div>
    </div>
</div>
@endsection