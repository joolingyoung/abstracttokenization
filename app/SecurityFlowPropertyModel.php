<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityFlowPropertyModel extends Model
{
    protected $table = 'security_flow_property';
    protected $fillable = [
        'id', 'userid', 'target-investor-irr', 'investment-profile', 'funds-due', 'target-equity-multiple', 
        'minimum-investment', 'distribution-period', 'target-investment-period', 'property-type', 'sponsor-co-investment', 
        'target-avg-investor-cash-yield', 'offers-due', 'distribution-commencement', 'property', 'opportunity_type', 
        'opportunity_description', 'property_address', 'city', 'state', 'zip', 'country', 'vacancy_rate', 'current_noi', 
        'annual_cash_flow', '1031_exchange', 'market_value', 'square_footage', 'property_class', 'total_debt', 'payoff_date', 
        'loan-type',	'developed', 'captables', 'pro-frorma-noi', 'distribution-frequency', 'equity-raise-floor-amount', 
        'total-capital-required', 'equity-raise-hard-cap', 'preferred-equity', 'common-equity','mezzanine-debt',
        'senior-debt', 'principles', 'status', 'created_at', 'updated_at', 'key-points', 'approval_token'
    ];
}
