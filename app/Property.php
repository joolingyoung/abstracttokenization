<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'id', 'userid', 'name', 'address', 'city',
        'state', 'zipcode', 'country', 'bankTransfer'];

    public function investors() {
        return $this->hasManyThrough('App\User', 'App\Investment', 'property_id', 'id', 'id', 'userid')->distinct();
    }

    public function investments() {
        return $this->hasMany('App\Investment');
    }

    public function distributions() {
        return $this->hasMany('App\Distribution');
    }

    public function getCurrentDistribution($investor_id, $current_year = false) {
        $distribution = $this->distributions
                        ->sortByDesc('date')
                        ->first();
        if ( $distribution === null )
            return 0;

        $d = $distribution
            ->distributionHistories
            ->where('user_id', $investor_id)
            ->first();

        if( $d !== null ) {
            return $d->amount;
        } else {
            return 0;
        }
    }

    public function getSumOfDistribution($investor_id, $current_year = false) {
        $query = DistributionHistory::where('user_id', $investor_id)
            ->join('distributions', 'distributions.id', 'distribution_history.id')
            ->where('distributions.property_id', $this->id);
        if ($current_year) {
            return $query->whereRaw('year(`date`) = ?', array(date('Y')))->sum('amount');
        } else {
            return $query->sum('amount');
        }
    }

    public function getCurrentDistributionTrend($investor_id) {
        $distributionLastMonth  = $this->distributions
            ->where('year(`date`) = ?', array(date('Y')))
            ->where('month(`date`) = ?', array(date('m') - 1))
            ->sortByDesc('date')
            ->first();

        $distributionCurrentMonth = $this->distributions
            ->where('year(`date`) = ?', array(date('Y')))
            ->where('month(`date`) = ?', array(date('m')))
            ->sortByDesc('date')
            ->first();

        if ($distributionLastMonth === null) {
            return 1;
        }

        if ($distributionCurrentMonth === null) {
            return 0;
        }

        $amountLastMonth = $distributionLastMonth
            ->distributionHistories
            ->where('user_id', $investor_id)
            ->first();

        $amountCurrentMonth =  $distributionCurrentMonth
            ->distributionHistories
            ->where('user_id', $investor_id)
            ->first();

        if ($amountLastMonth < $amountCurrentMonth) {
            return 1;
        }

        return 0;
    }

    public function getTotalMonthsHeld($user_id) {
        $current_date = new DateTime();
        $distribution = $this->distributions
                        ->where('userid', $user_id)
                        ->dateDesc()
                        ->first();

        if ($distribution === null) {
            return 1;
        }

        return (float)$current_date->diff(new DateTime())->format('%m');
    }

    public function getSummary($user_id) {
        $investment = $this->investments
                                ->where( 'userid', $user_id )
                                ->sortBy('contributed_at')
                                ->first();

        if ($investment == null || $investment->contributed_at == null) {
            return;
        }

        $last_distribution = $this->distributions
            ->where('userid', $user_id)
            ->sortByDesc('date')
            ->first();
        $distribution_trend = $this->getCurrentDistributionTrend($user_id);
        $investment_amount = $this->investments->sum('amount');
        $capital_contributed  = $this->investments->where('userid', $user_id)->sum('amount');

        // Current Data
        $current_cash_flow  = $this->getCurrentDistribution($user_id);
        $cumulative_cash_distribution    = DistributionHistory::sumHistoricDistribution($this->id, $user_id);
        $current_annualized = $current_cash_flow / $capital_contributed * 12;
        $current_pre_tax_annualized = $current_annualized / (1-0.45);

        // Cumulative Data
        $investment_date = $investment->contributed_at;

        if($last_distribution == null) {
            $month_held = 1;
        } else {
            $month_held = ($last_distribution->date->timestamp - $investment_date->timestamp) / (30*60*60*24);
        }
        $cumulative_return  = $cumulative_cash_distribution / $capital_contributed;
        $cumulative_annualized = $cumulative_return / $month_held * 12;
        $pre_tax_annualized_return = $cumulative_annualized / (1-0.45);

        // Property Data
        $percentage_ownership = $capital_contributed / $investment_amount;
        $last_distribution_date = isset($last_distribution) ? $last_distribution->date : Carbon::today();
        $distribution_ytd = $this->getSumOfDistribution($user_id, true);

        $report = Report::where('parent', $this->id)
        ->latest('created_at')
        ->first();

        $current_occupancy = isset( $report->id ) == true ? OperationHighlight::getOccupancy($report->id) : '0';
        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address
        ], compact(
            'investment_date',
            'investment',
            'last_distribution_date',
            'cumulative_return',
            'cumulative_annualized',
            'pre_tax_annualized_return',
            'current_annualized',
            'cumulative_cash_distribution',
            'current_cash_flow',
            'current_pre_tax_annualized',
            'capital_contributed',
            'percentage_ownership',
            'distribution_trend',
            'distribution_ytd',
            'current_occupancy'
        ));
    }

    public function getDistributionHistory($user_id) {
        return Distribution::where('distributions.property_id', $this->id)
            ->join('distribution_history', 'distributions.id' , '=', 'distribution_history.distribution_id')
            ->where( 'distribution_history.user_id', $user_id )
            ->where( 'distribution_history.amount', '>', '0' )
            ->orderBy('distributions.date')
            ->get();
    }


    // TO BE DERPECATED
    public function getFakeTypeAttribute() {
        return 'sproperty';
    }

    public function investmentsFor($user_id) {
        return $this->investments()->where('userid', $user_id);
    }

}
