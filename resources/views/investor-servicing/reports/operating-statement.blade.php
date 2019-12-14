<!DOCTYPE html>
<html>
<head>
    <style type="text/css" media="all">
        .card-body {
            margin-bottom: 20px;
            border-radius: 8px;
            color: rgb(17,40,70);
            line-height: 20px;
        }
        .row {
            border-bottom: 1px solid #dedede;
            padding-left: 20px;
        }
        .border-bottom-none {
            border: none;
        }
        .col {
            display: block;
            float: left;
            width: 33%;
            min-height: 10px;
        }
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .sub-head-title, th {
            font-size: 18px;
        }
        .padding-vertical-m {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .logo {
            height: 50px;
            width: auto;
        }
        .bold-font {
            font-weight: bold;
        }
        .header-title {
            font-size: 19px;
        }
        .header-tip-title {
            font-size: 10px;
        }
        .field-text {
            float: right;
        }
        .padding-m  {
            padding-top: 20px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }
        th {
            text-align: left;
            background-color: rgb(232, 248, 247);
        }
        td,th {
            position: relative;
            padding: 16px 0px;
            border-right-width: 0;
            border-left-width: 0;
        }
        th:first-child, td:first-child, td:last-child {
            padding: 20px;
        }
        td {
            border-bottom: 1px solid #dedede;
            position: relative;
            white-space: nowrap;
        }
        .currency {
            text-align: right;
            padding-left: 20px;
        }
        .currency::before{
            content: '$ ';
            display: block;
            position: absolute;
            left: 10px;
        }
        td.number {
            text-align: right;
        }
        td.highlight {
            border-bottom-color: black;
        }
        .footer-comment {
            width: 70%;
            display:inline-block;
        }
        .each-line-large {
            float: left;
            width: 40%;
        }
    </style>

</head>
<body>
    <div class="card-body">
        <div class="row padding-vertical-m">
            <div class="col">
                <img src="{{asset('img/acg-dark-logo.png')}}" class="logo push-up-nav">
            </div>
            <div class="col"></div>
            <div class="col sub-head-title bold-font">
                <p>Property Operating Statement</p>
            </div>
        </div>
        <div class="row padding-vertical-m bold-font">
            <div class="col">
                <div class="header-tip-title">Sponsor Name</div>
                <div class="header-title">{{$company_name}}</div>
            </div>
            <div class="col">
                <div class="header-tip-title">Property Name</div>
                <div class="header-title">{{$property_name}}</div>
            </div>
            <div class="col">
                <div class="header-tip-title">Report Date</div>
                <div class="header-title">{{$report_date}}</div>
            </div>
        </div>


        <table cellspacing='0'>
            <tr>
                <th width="270px">Occupancy</th>
                <th width="100px"></th>
                <th></th>
                <th width="100px"></th>
                <th></th>
                <th width="100px"></th>
                <th></th>
            </tr>
            <tr>
                <td>Occupancy Rate</td>
                <td class="number">{{number_format($operation_data->occupancy_rate * 100, 2)}}%</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>Rental Income</th>
                <th width="100px">Current</th>
                <th></th>
                <th width="100px">YTD</th>
                <th></th>
                <th width="100px">Annualized</th>
                <th></th>
            </tr>
            <tr>
                <td>Rental Income</div>
                <td class="currency">{{number_format($property_data->rental_income_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->rental_income_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->rental_income_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Other Income</td>
                <td class="currency highlight">{{number_format($property_data->other_rental_income_current)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($property_data->other_rental_income_ytd)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($property_data->other_rental_income_current * 12)}}</td>
                <td></td>
            </tr>
            <tr class="bold-font">
                <td>Total Income</td>
                <td class="currency">{{number_format($property_data->total_rental_income_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->total_rental_income_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->total_rental_income_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <th>Operating Costs</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>Administrative</td>
                <td class="currency">{{number_format($property_data->administrative_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->administrative_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->administrative_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Payroll</td>
                <td class="currency">{{number_format($property_data->payroll_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->payroll_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->payroll_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Marketing</td>
                <td class="currency">{{number_format($property_data->marketing_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->marketing_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->marketing_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Utilities</td>
                <td class="currency">{{number_format($property_data->utilities_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->utilities_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->utilities_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Repairs & Maintenance (turn over)</td>
                <td class="currency">{{number_format($property_data->repairs_maintenance_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->repairs_maintenance_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->repairs_maintenance_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Grounds</td>
                <td class="currency">{{number_format($property_data->grounds_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->grounds_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->grounds_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Other Operating</td>
                <td class="currency">{{number_format($property_data->other_operating_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->other_operating_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->other_operating_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Licenses & Permits</td>
                <td class="currency">{{number_format($property_data->licenses_permits_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->licenses_permits_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->licenses_permits_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Property Management Fees</td>
                <td class="currency">{{number_format($property_data->property_management_fees_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->property_management_fees_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->property_management_fees_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>RE Taxes</td>
                <td class="currency">{{number_format($property_data->re_taxes_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->re_taxes_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->re_taxes_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Insurance</td>
                <td class="currency">{{number_format($property_data->insurance_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->insurance_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->insurance_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Replacement Reserves</td>
                <td class="currency highlight">{{number_format($operation_data->replacement_reserve_escrow)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($operation_data->replacement_reserve_escrow)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($operation_data->replacement_reserve_escrow * 12)}}</td>
                <td></td>
            </tr>
            <tr class="bold-font">
                <td>Total Operating Costs</td>
                <td class="currency">{{number_format($property_data->total_operating_costs_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->total_operating_costs_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($property_data->total_operating_costs_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <th>Net Operating Income</th>
                <th class="currency">{{number_format($property_data->net_operating_income_current)}}</th>
                <th></th>
                <th class="currency">{{number_format($property_data->net_operating_income_ytd)}}</th>
                <th></th>
                <th class="currency">{{number_format($property_data->net_operating_income_current * 12)}}</th>
                <th></th>
            </tr>
        </table>
        <div class="row border-bottom-none padding-l">
            <div class="footer-comment">
                <p>*Depreciation must be calculated at the trustee level due to the nature of initial
                    investments that may, or may not, have utilized IRC Section 1031 to defer gains on
                    prior investment(s). Please consult your tax advisor for an estimate of this amount.
                </p>
            </div>
            <img src="{{asset('img/apple-touch-icon.png')}}" class="logo push-up-nav" style="float: right;">
        </div>
    </div>
</body>
</html>
