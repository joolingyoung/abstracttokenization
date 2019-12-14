<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [ 'userid', 'parent', 'type', 'quater', 'month', 'year', 'file'];

    public function user()
    {
        return $this->belongsTo('App\User', 'userid');
    }

    public function parentProperty()
    {
        return $this->belongsTo('App\Property', 'parent');
    }

    public function dstReport()
    {
        return $this->hasOne('App\DstReport');
    }

    public function operationHighlight()
    {
        return $this->hasOne('App\OperationHighlight');
    }

    public function cashDistributionSummary()
    {
        return $this->hasOne('App\CashDistributionSummary');
    }

    public function propertyFinancialHighlight()
    {
        return $this->hasOne('App\PropertyFinancialHighlight');
    }
}
