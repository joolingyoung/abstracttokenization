<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountVerification extends Model
{
    protected $table = 'account_verification';
    protected $fillable = [
        'id', 'userid', 'company_name', 'company_website', 'first_name', 'last_name', 'work_phone','mobile', 'company_address', 'company_address_2', 'city', 'state', 'zip', 'email', 'job_title', 'tin', 'country', 'bio','portfolio_activity_amount', 'assets_under_management', 'square_feet_managed', 'principle_company_name','principle_company_website', 'principle_website', 'reference_type_1', 'reference_name_1', 'reference_phone_1','reference_email_1', 'reference_type_2', 'reference_name_2', 'reference_phone_2', 'reference_email_2', 'reference_type_3','reference_name_3', 'reference_phone_3', 'reference_email_3', 'reference_type_4', 'reference_name_4', 'reference_phone_4','reference_email_4', 'status', 'approval_token'
    ];
    public function getFullName()
    {
        $value = $this->first_name . ' ' . $this->last_name;
        return $value;
    }
}
