<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodyAccounts extends Model
{
    //
    protected $table = "custody_accounts";
    protected $fillable = [
        'id', 'user_id', 'user_email', 'account_id', 'token_symbol', 'token_count', 'token_balance', 'total_budget', 'updated_at'
    ];
}
