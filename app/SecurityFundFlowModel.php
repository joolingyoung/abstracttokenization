<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityFundFlowModel extends Model
{
    protected $table = 'security_fund_flow';
    protected $fillable = [
        'id', 'userid', 'target-investor-irr', 'investment-profile', 'funds-due', 'target-equity-multiple', 
        'minimum-investment', 'distribution-period', 'target-investment-period', 'property-type', 'sponsor-co-investment', 
        'target-avg-investor-cash-yield', 'offers-due', 'distribution-commencement', 'fund-name', 'opportunity-type', 
        'type-of-fund', 'capital-origin', 'fund-address', 'city', 'state', 'zip', 'country', 'fund-description', 'captables', 
        'minimum-raise-amount', 'distribution-frequency', 'maximum-raise-amount', 'total-capital-required', 'preferred-equity', 
        'common-equity', 'mezzanine-debt', 'senior-debt', 'vacancy-rate', 'proforma-current-noi', 'annual-cash-flow', 
        '1031-exchange', 'market-value', 'square-footage', 'property-class', 'total-debt', 'payoff-date', 'loan-type', 
        'developed', 'existing-properties', 'principles', 'key-points', 'status', 'created_at', 'updated_at', 'approval_token'
    ];
}
