<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionHistory extends Model
{
    protected $table = 'distribution_history';

    public function distribution()
    {
        return $this->belongsTo('App\Distribution');
    }

    public static function sumHistoricDistribution($property_id, $user_id, $date = null) {
        $query = Distribution::where('property_id', $property_id)
            ->join('distribution_history', 'distributions.id', 'distribution_history.distribution_id')
            ->where('distribution_history.user_id', $user_id);
        if($date != null) {
            $query = $query->where('distributions.date', '<', $date);
        }
        return $query->sum('distribution_history.amount');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
