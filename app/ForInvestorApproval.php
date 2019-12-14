<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForInvestorApproval extends Model
{
    protected $table = 'property';
    protected $fillable = [
        'id', 'userid', 'opportunity_name', 'opportunity_address', 'city', 'state', 'zipcode', 'country', 'bankTransfer', 'captables', 'created_at', 'updated_at', 'status', 'approval_token'
    ];
}