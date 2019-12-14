<!DOCTYPE html>
<html>
<head>
    
    <style type="text/css" media="all">
        .card-body {
            background-color: rgb(232, 232, 232);
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-title{
            background-color: rgb(56, 76, 98);
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            color: white;
            width: 100%;
            border-bottom: 2px solid #EEF1F7;
            box-sizing: border-box;
            border-bottom: none;
            padding: 10px;
        }
        .operation-body { 
            margin-bottom: 20px;
        }
        .property-body{
            margin-bottom: 20px;
        }
        .card-title span {
            font-size: 1.2em;
            font-weight: bold;
        }
        .card-content {
            padding-left: 20px;
        }

        .each-line {
            float: left;
            width: 33.33%;
        }
        .each-line-cash{
            float: left;
            width: 50%;
            margin-right: 40px;
        }
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .sub-head-title{
            color: rgb(56, 90, 98);
        }
        .head-data{
            background-color: rgb(56, 76, 98);
            font-size: 1.6em;
            color: white;
            text-align: center;
            margin-bottom: 50px;
            padding-bottom:10px;
            padding-top: 10px;
            font-weight: bold;
        }
        .head-item{
            margin: 5px;
        }
    </style>
    
</head>
<body>
<div>
    <div class="head-data">
        <div class="head-item">Sponsor Name : {{$company_name}}</div>
        <div class="head-item">Property Name : {{$property_name}}</div>
        <div class="head-item">Report Date: {{$report_date}}</div>
    </div>
    <div class="card-body">
        <div class="card-title">
            <span>DST Financial Report</span>
        </div>
        <div class="card-content">
            <div class="table-grid">
                <div class="row middle-xs">
                    <div class="each-line sub-head-title">
                        <h3>Rental Income</h3>
                    </div>
                    <div class="each-line hide-sm sub-head-title">
                        <h5>Current</h5>
                    </div>
                    <div class="each-line hide-sm sub-head-title">
                        <h5>YTD</h5>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Base Rent</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->base_rent_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->base_rent_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Annual Rent</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->annual_rent_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->annual_rent_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Percentage Rent</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->percentage_rent_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->percentage_rent_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Total Rental Income</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->total_rental_income_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->total_rental_income_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line-header sub-head-title">
                        <h3>Expenses</h3>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Interest Expense</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->interest_expense_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->interest_expense_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Real Estate Taxes</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->real_estate_taxes_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->real_estate_taxes_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Insurance</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->insurance_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->insurance_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Lender Reserves</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->lender_reserves_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->lender_reserves_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Signatory Trustee Fee</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->signatory_trustee_fee_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->signatory_trustee_fee_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Independent Trustee Fee</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->independent_trustee_fee_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->independent_trustee_fee_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Total Expenses</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->total_expenses_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->total_expenses_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs margin-bottom-m">
                    <div class="each-line">
                        <p>Net Income beore Depreciation/Amrortization*</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($dst_data->net_income_before_depr)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($dst_data->net_income_before_amort)}}</p>
                    </div>
                </div>
            </div>
            <p>*Depreciation must be calculated at the trustee level due to the nature of initial
                investments that may, or may not, have utilized IRC Section 1031 to defer gains on
                prior investment(s). Please consult your tax advisor for an estimate of this amount.
            </p>
        </div>
    </div>
    <div class="card-body operation-body">
        <div class="card-title">
            <span>Operational Highlights</span>
        </div>
        <div class="card-content">
            <div class="table-grid">
                <div class="row middle-xs">
                    <div class="each-line-header sub-head-title">
                        <h3>Mortgage Information</h3>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Current Principal Balance</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->current_principal_balance)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Annual Interest Rate</p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($operation_data->annual_interest_rate * 100, 2)}}%</p>
                    </div>
                </div>
                <div class="row middle-xs margin-bottom-m">
                    <div class="each-line">
                        <p>Maturity Date</p>
                    </div>
                    <div class="each-line">
                        <p>{{$operation_data->maturity_date}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line-header sub-head-title">
                        <h3>Reserve Balances</h3>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Tax Escrow</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->tax_escrow)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Insurance Escrow</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->insuarance_escrow)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line">
                        <p>Replacement Reserve Escrow</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->replacement_reserve_escrow)}}</p>
                    </div>
                </div>
                <div class="row middle-xs margin-bottom-m">
                    <div class="each-line">
                        <p>Total Lender Reserves</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->total_lender_reserves)}}</p>
                    </div>
                </div>
                <div class="row margin-bottom-m">
                    <div class="each-line-header sub-head-title">
                        <h3>DST Reserves</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line">
                        <p>Trust Reserve</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->trust_reserve)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line">
                        <p>Total DST Reserves</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->total_dst_reserves)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line">
                        <p>Total Reserves</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($operation_data->total_reserves)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line">
                        <p>Occupancy Rate</p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($operation_data->occupancy_rate * 100, 2)}}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body property-body">
        <div class="card-title">
            <span>Property Financial Highlights</span>
        </div>
        <div class="card-content">
            <div class="table-grid">
                <div class="row middle-xs">
                    <div class="each-line sub-head-title">
                        <h3>Rental Income</h3>
                    </div>
                    <div class="each-line sub-head-title">
                        <h5>Current</h5>
                    </div>
                    <div class="each-line sub-head-title">
                        <h5>YTD</h5>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Rental Income</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->rental_income_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->rental_income_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Other Rental Income</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->other_rental_income_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->other_rental_income_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs margin-bottom-m">
                    <div class="each-line">
                        <p>Total Rental Income</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->total_rental_income_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->total_rental_income_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line-header sub-head-title">
                        <h3>Operating Costs:</h3>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Administrative</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->administrative_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->administrative_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Payroll</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->payroll_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->payroll_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Marketing</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->marketing_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->marketing_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Utilities</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->utilities_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->utilities_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Repairs & Maintenance</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->repairs_maintenance_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->repairs_maintenance_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Grounds</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->grounds_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->grounds_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Other Operating</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->other_operating_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->other_operating_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Licenses & Permits</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->licenses_permits_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->licenses_permits_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Property Management Fees</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->property_management_fees_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->property_management_fees_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>RE Taxes</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->re_taxes_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->re_taxes_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Insurance</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->insurance_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->insurance_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Capital Activity</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->capital_activity_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->capital_activity_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Total Operating Costs</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->total_operating_costs_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->total_operating_costs_ytd)}}</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="each-line">
                        <p>Net Operating Costs</p>
                    </div>
                    <div class="each-line current">
                        <p>${{number_format($property_data->net_operating_income_current)}}</p>
                    </div>
                    <div class="each-line ytd">
                        <p>${{number_format($property_data->net_operating_income_ytd)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-title">
            <span>Cash Distributions Summary</span>
        </div>
        <div class="card-content">
            <div class="table-grid">
                <div class="row">
                    <div class="each-line-cash">
                        <p>1. Cumulative Cash Distributions</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($cash_data->cumulative_cash_distribution)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line-cash">
                        <p>2. Cumulative Annualized Cash Distribution as a % of original investment
                        </p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($cash_data->cumulative_annualized * 100, 2)}}%</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line-cash">
                        <p>3. Pre-Tax Cumulative Annualized Cash Distributions as a % of original
                            investment</p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($cash_data->pre_tax_cumulative * 100, 2)}}%</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line-cash">
                        <p>4. Current Month Cash Distribution</p>
                    </div>
                    <div class="each-line">
                        <p>${{number_format($cash_data->current_month_cash)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line-cash">
                        <p>5. Current Month Annualized Cash Distributions as a % of original
                            investment</p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($cash_data->current_month_annualized * 100, 2)}}%</p>
                    </div>
                </div>
                <div class="row">
                    <div class="each-line-cash">
                        <p>6. Pre-Tax Current Month Annualized Cash Distributions 
                        as a % of original investment</p>
                    </div>
                    <div class="each-line">
                        <p>{{number_format($cash_data->pre_tax_current_annualized * 100, 2)}}%</p> <!-- Cant find Insurance Escrow field in the table-->
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>Pre-Tax Returns calculated using the highest Federal Marginal tax rate of
                            37% plus an 8% allowance for state and local tax</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>