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
        td.currency {
            text-align: right;
            padding-left: 20px;
        }
        td.currency::before{
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
                <p>DST Financial Reports</p>
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
                <th width="33%">Rental Income</th>
                <th width="100px">Current</th>
                <th></th>
                <th width="100px">YTD</th>
                <th></th>
                <th width="100px">Annualized</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    Base Rent
                </td>
                <td class="currency">
                    {{number_format($dst_data->base_rent_current)}}
                </td>
                <td></td>
                <td class="currency">{{number_format($dst_data->base_rent_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->base_rent_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    Annual Rent
                </td>
                <td class="currency">
                    {{number_format($dst_data->annual_rent_current)}}
                </td>
                <td></td>
                <td class="currency">
                    {{number_format($dst_data->annual_rent_ytd)}}
                </td>
                <td></td>
                <td class="currency">
                    {{number_format($dst_data->annual_rent_current * 12)}}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    Percentage Rent
                </td>
                <td class="currency highlight">{{number_format($dst_data->percentage_rent_current)}}</td>
                <td></td>
                <td class="currency highlight">
                    {{number_format($dst_data->percentage_rent_ytd)}}
                </td>
                <td></td>
                <td class="currency highlight">
                    {{number_format($dst_data->percentage_rent_current * 12)}}
                </td>
                <td></td>
            </tr>
            <tr class="bold-font">
                <td>Total Rental Income</td>
                <td class="currency">{{number_format($dst_data->total_rental_income_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->total_rental_income_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->total_rental_income_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <th class="bold-font">Expenses</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>Interest Expense</div>
                <td class="currency">{{number_format($dst_data->interest_expense_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->interest_expense_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->interest_expense_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Real Estate Taxes</div>
                <td class="currency">{{number_format($dst_data->real_estate_taxes_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->real_estate_taxes_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->real_estate_taxes_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Insurance</td>
                <td class="currency">{{number_format($dst_data->insurance_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->insurance_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->insurance_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Lender Reserves</td>
                <td class="currency">{{number_format($dst_data->lender_reserves_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->lender_reserves_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->lender_reserves_current * 12)}}</td>
                <td></td>
            </tr>
            <tr>
                <td>Signatory Trustee Fee</td>
                <td class="currency">{{number_format($dst_data->signatory_trustee_fee_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->signatory_trustee_fee_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->signatory_trustee_fee_current * 12)}}</td>
                <td></td>
            </td>
            <tr>
                <td>Independent Trustee Fee</td>
                <td class="currency highlight">{{number_format($dst_data->independent_trustee_fee_current)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($dst_data->independent_trustee_fee_ytd)}}</td>
                <td></td>
                <td class="currency highlight">{{number_format($dst_data->independent_trustee_fee_current * 12)}}</td>
                <td></td>
            </div>
            <tr class="bold-font">
                <td>Total Expenses</td>
                <td class="currency">{{number_format($dst_data->total_expenses_current)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->total_expenses_ytd)}}</td>
                <td></td>
                <td class="currency">{{number_format($dst_data->total_expenses_current * 12)}}</td>
                <td></td>
            </tr>
            <tr class="bold-font">
                <th>Net Income beore Depreciation<br/>/Amrortization*</th>
                <th class="currency">{{number_format($dst_data->net_income_before_depr)}}</th>
                <th></th>
                <th class="currency">{{number_format($dst_data->net_income_before_amort)}}</th>
                <th></th>
                <th class="currency">{{number_format($dst_data->net_income_before_depr * 12)}}</th>
                <th></th>
            </tr>
        </table>

        <div class="row border-bottom-none">
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
