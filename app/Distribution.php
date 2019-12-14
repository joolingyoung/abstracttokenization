<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \HistoricTableHelper;

class Distribution extends Model
{
    protected $fillable = [
        'userid',
        'property_id',
        'type',
        'name',
        'date',
        'period_start_date',
        'period_end_date',
        'cash_flow_type',
        'total_amount',
        'file'
    ];

    protected $dates = [
        'date'
    ];

    public function property() {
        return $this->belongsTo('App\Property', 'property_id');
    }
    /**
     * Get the historic distribution for the distribution.
     */
    public function distributionHistories()
    {
        return $this->hasMany('App\DistributionHistory');
    }

    public function scopeDateDesc($query) {
        return $query->orderBy('date', 'DESC');
    }

    public function generateHistory($isNewData) {
        $property = $this->property;
        $investments = $property->investments;

        $distribution_history   = [];
        $distribution_data      = [];
        $investors_total_amounts = 0;

        foreach ($investments as $investment) {
            if ($investment->userid == $this->userid) {
                continue;
            }
            $calc_distribution = 0;
            if ($isNewData) {
                $calc_distribution = $this->total_amount * $investment->share;
            } else {
                $calc_distribution = (int) HistoricTableHelper::calculate_distribution($this->property_id, $this->date, null, $investment, $this->total_amount);
            }

            if ((int) $calc_distribution > 0) {
                $investors_total_amounts += $calc_distribution;
                $distribution_history[] = [
                    'user_id'       => $investment->userid,
                    'distribution_id'   => $this->id,
                    'amount'      => $calc_distribution
                ];
            }
        }

        $sponsor_amount = $this->total_amount - $investors_total_amounts;
        $distribution_history[] = [
            'user_id'       => $this->userid,
            'distribution_id'   => $this->id,
            'amount'      => $sponsor_amount
        ];

        DistributionHistory::insert($distribution_history);
    }

    public function getCSVFile() {
        $property = $this->property;
        $sponsor = $property->investments->where('userid', $this->userid)->first();
        $company_name = $sponsor->entity_name;
        $investments = $property->investments;
        $distribution_data = [];
        foreach ($investments as $investment) {
            $history = $this->distributionHistories->where('user_id', $investment->userid)->first();
            if (isset($history)) {
                $distribution_data[] = [
                        'routing_number'    => $investment->routing_number,
                        'account_number'    => $investment->account_number,
                        'account_type'      => $investment->type,
                        'investor_name'     => $investment->entity_name,
                        'dist_amount'       => $history->amount
                ];
            }
        }
        return HistoricTableHelper::process_file_data([
            'temp_name' => $this->name,
            'company_name' => $company_name,
            'file_path' => $this->file,
            'total_amount' => $this->total_amount,
            'distributions' => $distribution_data
        ], false);
    }
}
