<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DstReport extends Model
{
    protected $table = 'dst_report';

    protected $fillable = [
        'base_rent_current','base_rent_ytd',
        'annual_rent_current', 'annual_rent_ytd',
        'percentage_rent_current', 'percentage_rent_ytd',
        'total_rental_income_current', 'total_rental_income_ytd',
        'interest_expense_current', 'interest_expense_ytd',
        'real_estate_taxes_current', 'real_estate_taxes_ytd',
        'insurance_current', 'insurance_ytd',
        'lender_reserves_current', 'lender_reserves_ytd',
        'signatory_trustee_fee_current', 'signatory_trustee_fee_ytd',
        'independent_trustee_fee_current', 'independent_trustee_fee_ytd',
        'total_expenses_current', 'total_expenses_ytd',
        'net_income_before_depr', 'net_income_before_amort'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
