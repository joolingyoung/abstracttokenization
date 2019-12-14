<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">Sponsor Name</th>
            <th style="font-weight: bold;">Property Name</th>
            <th style="font-weight: bold;">Report Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $company_name }}</td>
            <td>{{ $property_name }}</td>
            <td>{{ $report_date }}</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: bold;text-decoration: underline;">DST Financial Report</th>
        </tr>
        <tr></tr>
        <tr>
            <th style="font-weight: bold;">Rental Income</th>
            <th></th>
            <th>Current</th>
            <th>YTD</th>
        </tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>Base Rent</td>
            <td>${{number_format($dst_data->base_rent_current)}}</td>
            <td>${{number_format($dst_data->base_rent_ytd)}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Annual Rent</td>
            <td>${{number_format($dst_data->annual_rent_current)}}</td>
            <td>${{number_format($dst_data->annual_rent_ytd)}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Percentage Rent</td>
            <td>${{number_format($dst_data->percentage_rent_current)}}</td>
            <td>${{number_format($dst_data->percentage_rent_ytd)}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Rental Income</td>
            <td></td>
            <td>${{number_format($dst_data->total_rental_income_current)}}</td>
            <td>${{number_format($dst_data->total_rental_income_ytd)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Expenses</td>
        </tr>
        <tr>
            <td></td>
            <td>Interest Expense</td>
            <td>${{number_format($dst_data->interest_expense_current)}}</td>
            <td>${{number_format($dst_data->interest_expense_ytd)}}</td>
        <tr>
        <tr>
            <td></td>
            <td>Real Estate Taxes</td>
            <td>${{number_format($dst_data->real_estate_taxes_current)}}</td>
            <td>${{number_format($dst_data->real_estate_taxes_ytd)}}</td>
        <tr>
        <tr>
            <td></td>
            <td>Insurance</td>
            <td>${{number_format($dst_data->insurance_current)}}</td>
            <td>${{number_format($dst_data->insurance_ytd)}}</td>
        <tr>
        <tr>
            <td></td>
            <td>Lender Reserves</td>
            <td>${{number_format($dst_data->lender_reserves_current)}}</td>
            <td>${{number_format($dst_data->lender_reserves_ytd)}}</td>
        <tr>
        <tr>
            <td></td>
            <td>Signatory Trustee Fee</td>
            <td>${{number_format($dst_data->signatory_trustee_fee_current)}}</td>
            <td>${{number_format($dst_data->signatory_trustee_fee_ytd)}}</td>
        <tr>
        <tr>
            <td></td>
            <td>Independent Trustee Fee</td>
            <td>${{number_format($dst_data->independent_trustee_fee_current)}}</td>
            <td>${{number_format($dst_data->independent_trustee_fee_ytd)}}</td>
        <tr>
        <tr>
            <td style="font-weight: bold;">Total Expenses</td>
            <td></td>
            <td>${{number_format($dst_data->total_expenses_current)}}</td>
            <td>${{number_format($dst_data->total_expenses_ytd)}}</td>
        <tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Net Income beore Depreciation/Amrortization*</td>
            <td></td>
            <td>${{number_format($dst_data->net_income_before_depr)}}</td>
            <td>${{number_format($dst_data->net_income_before_amort)}}</td>
        </tr>
        <tr>
            <td>* Depreciation must be calculated at the trustee level due to<td>
        </tr>
        <tr>
            <td>  the nature of initial investments that may, or may not, have<td>
        </tr>
        <tr>
            <td>  utilized IRC Section 1031 to defer gains on prior investment(s).<td>
        </tr>
        <tr>
            <td>  Please consult your tax advisor for an estimate of this amount.<td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: bold;text-decoration: underline;">Operations Highlights</th>
        </tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-weight: bold;">Mortgage Information</td>
        </tr>
        <tr>
            <td>Current Principal Balance</td>
            <td></td>
            <td>${{number_format($operation_data->current_principal_balance)}}</td>
        </tr>
        <tr>
            <td>Annual Interest Rate</td>
            <td></td>
            <td>{{number_format($operation_data->annual_interest_rate * 100, 2)}}%</td>
        </tr>
        <tr>
            <td>Maturity Date</td>
            <td></td>
            <td>{{$operation_data->maturity_date}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Reserve Balances</td>
        </tr>
        <tr>
            <td>Tax Escrow</td>
            <td></td>
            <td>${{number_format($operation_data->tax_escrow)}}</td>
        </tr>
        <tr>
            <td>Insurance Escrow</td>
            <td></td>
            <td>${{number_format($operation_data->insuarance_escrow)}}</td>
        </tr>
        <tr>
            <td>Replacement Reserve Escrow</td>
            <td></td>
            <td>${{number_format($operation_data->replacement_reserve_escrow)}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Lender Reserves</td>
            <td></td>
            <td>${{number_format($operation_data->total_lender_reserves)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">DST Reserves</td>
        </tr>
        <tr>
            <td>Trust Reserve</td>
            <td></td>
            <td>${{number_format($operation_data->trust_reserve)}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total DST Reserves</td>
            <td></td>
            <td>${{number_format($operation_data->total_dst_reserves)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Total Reserves</td>
            <td></td>
            <td>${{number_format($operation_data->total_reserves)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Occupancy Rate</td>
            <td></td>
            <td>{{number_format($operation_data->occupancy_rate * 100, 2)}}%</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: bold;text-decoration: underline;">Property Financial Highlights</th>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td>Current</td>
            <td>YTD</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-weight: bold;">Rental Income:</td>
        </tr>
        <tr>
            <td>Rental Income</td>
            <td>${{number_format($property_data->rental_income_current)}}</td>
            <td>${{number_format($property_data->rental_income_ytd)}}</td>
        </tr>
        <tr>
            <td>Other Rental Income</td>
            <td>${{number_format($property_data->other_rental_income_current)}}</td>
            <td>${{number_format($property_data->other_rental_income_ytd)}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Rental Income</td>
            <td>${{number_format($property_data->total_rental_income_current)}}</td>
            <td>${{number_format($property_data->total_rental_income_ytd)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-weight: bold;">Operating Costs:</td>
        </tr>
        <tr>
            <td>Administrative</td>
            <td>${{number_format($property_data->administrative_current)}}</td>
            <td>${{number_format($property_data->administrative_ytd)}}</td>
        </tr>
        <tr>
            <td>Payroll</td>
            <td>${{number_format($property_data->payroll_current)}}</td>
            <td>${{number_format($property_data->payroll_ytd)}}</td>
        </tr>
        <tr>
            <td>Marketing</td>
            <td>${{number_format($property_data->marketing_current)}}</td>
            <td>${{number_format($property_data->marketing_ytd)}}</td>
        </tr>
        <tr>
            <td>Utilities</td>
            <td>${{number_format($property_data->utilities_current)}}</td>
            <td>${{number_format($property_data->utilities_ytd)}}</td>
        </tr>
        <tr>
            <td>Grounds</td>
            <td>${{number_format($property_data->grounds_current)}}</td>
            <td>${{number_format($property_data->grounds_ytd)}}</td>
        </tr>
        <tr>
            <td>Other Operating</td>
            <td>${{number_format($property_data->other_operating_current)}}</td>
            <td>${{number_format($property_data->other_operating_ytd)}}</td>
        </tr>
        <tr>
            <td>Licenses And Permits</td>
            <td>${{number_format($property_data->licenses_permits_current)}}</td>
            <td>${{number_format($property_data->licenses_permits_ytd)}}</td>
        </tr>
        <tr>
            <td>Property Management Fees</td>
            <td>${{number_format($property_data->property_management_fees_current)}}</td>
            <td>${{number_format($property_data->property_management_fees_ytd)}}</td>
        </tr>
        <tr>
            <td>RE Taxes</td>
            <td>${{number_format($property_data->re_taxes_current)}}</td>
            <td>${{number_format($property_data->re_taxes_ytd)}}</td>
        </tr>
        <tr>
            <td>Insurance</td>
            <td>${{number_format($property_data->insurance_current)}}</td>
            <td>${{number_format($property_data->insurance_ytd)}}</td>
        </tr>
        <tr>
            <td>Capital Activity</td>
            <td>${{number_format($property_data->capital_activity_current)}}</td>
            <td>${{number_format($property_data->capital_activity_ytd)}}</td>
        </tr>
        <tr>
            <td>Total Operating Costs</td>
            <td>${{number_format($property_data->total_operating_costs_current)}}</td>
            <td>${{number_format($property_data->total_operating_costs_ytd)}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Net Operating Costs</td>
            <td>${{number_format($property_data->net_operating_income_current)}}</td>
            <td>${{number_format($property_data->net_operating_income_ytd)}}</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: bold;text-decoration: underline;">Cach Distribution Summary</th>
        </tr>
        <tr></tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr>
            <td>1. Cumulative Cash Distributions</td>
            <td></td>
            <td>${{number_format($cash_data['cumulative_cash_distribution'])}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>2. Cumulative Annualized Cash Distribution as a % of original investment</td>
            <td></td>
            <td>{{number_format($cash_data['cumulative_annualized'] * 100, 2)}}%</td>
        </tr>
        <tr></tr>
        <tr>
            <td>3. Pre-Tax Cumulative Annualized Cash Distributions as a % of original investment</td>
            <td></td>
            <td>{{number_format($cash_data['pre_tax_annualized_return'] * 100, 2)}}%</td>
        </tr>
        <tr></tr>
        <tr>
            <td>4. Current Month Cash Distribution</td>
            <td></td>
            <td>${{number_format($cash_data['current_cash_flow'])}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>5. Current Month Annualized Cash Distributions as a % of original investment</td>
            <td></td>
            <td>{{number_format($cash_data['current_annualized'] * 100, 2)}}%</td>
        </tr>
        <tr></tr>
        <tr>
            <td>6. Pre-Tax Current Month Annualized Cash Distributions as a % of original investment</td>
            <td></td>
            <td>{{number_format($cash_data['current_pre_tax_annualized'] * 100, 2)}}%</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td>** Pre-Tax Returns calculated using the highest Federal Marginal</td>
        </tr>
        <tr>
            <td>   tax rate of 37% plus an 8% allowance for state and local tax</td>
        </tr>
    </tbody>
</table>
