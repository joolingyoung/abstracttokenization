<?php

namespace App;
use App\Investment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CashDistributionSummary extends Model
{
    protected $table = 'cash_distribution_summary';
    protected $fillable = [
        'report_id',
        'cumulative_cash_distribution',
        'cumulative_annualized',
        'pre_tax_cumulative',
        'current_month_cash',
        'current_month_annualized',
        'pre_tax_current_annualized'];
    //

    public function report() {
        $this->belongsTo('App\Report');
    }

    public static function getCurrentAnnualized($report_id) {
        $cash_data = static::where('cash_distribution_summary.report_id', $report_id )
            ->first();
        return $cash_data->cumulative_annualized;
    }

    private static function getTotalInvestmentDate($property_id) {
        $from = Investment::where('property_id', $property_id)->orderBy('contributed_at')->first()->contributed_at;

        $to = Carbon::now();

        return $from->diffInDays($to);
    }

    public function getCurrentCashFlow($user_id) {
        $report = $this->report;
        $investment = Investment::where('property_id', $report->parent)
            ->where('userid', $user_id)
            ->first();

        return $this->current_month_cash * $investment->share;

    }
}
