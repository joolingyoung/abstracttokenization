<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'userid',
        'property_id',
        'amount',
        'contributed_at',
        'entity_name',
        'share',
        'routing_number',
        'account_number',
        'type',
        'is_sponsor',
        'tax_id',
    ];

    protected $dates = [
        'contributed_at'
    ];

    public function property() {
        return $this->belongsTo('App\Property', 'property_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'userid');
    }
}
