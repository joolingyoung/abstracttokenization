<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationHighlight extends Model
{
    protected $table = 'operation_highlights';

    protected $fillable = [
        'current_principal_balance',
        'annual_interest_rate',
        'maturity_date',
        'current_amoritization',
        'tax_escrow',
        'insuarance_escrow',
        'replacement_reserve_escrow',
        'total_lender_reserves',
        'trust_reserve',
        'total_dst_reserves',
        'total_reserves',
        'occupancy_rate'
    ];

    public function report() {
        return $this->belongsTo('App\Report');
    }

    public static function getOccupancy($report_id) {
        $data = static::where('report_id', $report_id)
            ->select('occupancy_rate')
            ->first();

        return $data->occupancy_rate;
    }
}
