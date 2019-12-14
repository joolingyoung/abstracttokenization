<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFinancialHighlight extends Model
{
    protected $fillable = ['report_id',
        'rental_income_current',
        'rental_income_ytd',
        'other_rental_income_current',
        'other_rental_income_ytd',
        'total_rental_income_current',
        'total_rental_income_ytd',
        'administrative_current',
        'administrative_ytd',
        'payroll_current',
        'payroll_ytd',
        'marketing_current',
        'marketing_ytd',
        'utilities_current',
        'utilities_ytd',
        'repairs_maintenance_current',
        'repairs_maintenance_ytd',
        'grounds_current',
        'grounds_ytd',
        'other_operating_current',
        'other_operating_ytd',
        'licenses_permits_current',
        'licenses_permits_ytd',
        'property_management_fees_current',
        'property_management_fees_ytd',
        're_taxes_current',
        're_taxes_ytd',
        'insurance_current',
        'insurance_ytd',
        'capital_activity_current',
        'capital_activity_ytd',
        'total_operating_costs_current',
        'total_operating_costs_ytd',
        'net_operating_income_current',
        'net_operating_income_ytd'];


    public static function getTableData($report_id) {
        $cap = static::where('property_financial_highlights.report_id', $report_id )
            ->join('reports', 'property_financial_highlights.report_id', '=', 'reports.id')
            ->first();
        return $cap;
    }
}
