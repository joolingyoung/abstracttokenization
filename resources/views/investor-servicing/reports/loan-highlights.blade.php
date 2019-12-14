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
            left: 0px;
        }
        td.number {
            text-align: right;
        }
        td.highlight {
            border-bottom-color: black;
        }
    </style>

</head>
<body>
    <div class="card-body">
        <div class="row padding-vertical-m">
            <div class="col" style="d">
                <img src="{{asset('img/acg-dark-logo.png')}}" class="logo push-up-nav">
            </div>
            <div class="col"></div>
            <div class="col sub-head-title bold-font">
                <p>Loan and Reserve Highlights</p>
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
                <th width="33%">Mortgage Information</th>
                <th width="10%"></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    Current Principal Balance
                </td>
                <td class="currency">
                    {{number_format($operation_data->current_principal_balance)}}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Annual Interest Rate</td>
                <td class="number">
                    {{number_format($operation_data->annual_interest_rate * 100, 2)}}%
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Current Amoritization</td>
                <td class="currency">
                    <div>
                        {{number_format($operation_data->current_amoritization)}}
                    </div>
                </td>
                <td>
                </td>
            </tr>

            <tr class="bold-font">
                <td>Maturity Date</td>
                <td class="number">
                    {{$operation_data->maturity_date}}
                </td>
                <td></td>
            </tr>

            <tr>
                <th width="33%">Reserve Balances</th>
                <th width="10%"></th>
                <th></th>
            </tr>
            <tr>
                <td>Tax Escrow</td>
                <td class="currency">
                    <div>{{number_format($operation_data->tax_escrow)}}</div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    Insurance Escrow
                </td>
                <td class="currency">
                    <div>{{number_format($operation_data->insuarance_escrow)}}</div>
                </div>
                <td></td>
            </tr>
            <tr>
                <td>Replacement Reserve Escrow</td>
                <td class="currency highlight">
                    <div>{{number_format($operation_data->replacement_reserve_escrow)}}</div>
                </div>
                <td></td>
            </tr>
            <tr class="bold-font">
                <td>Total Lender Reserves</div>
                <td class="currency">
                    <div>
                        {{number_format($operation_data->total_lender_reserves)}}
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <th>DST Reserves</th>
                <th></th>
                <th></th>
            </td>
            <tr>
                <td>Trust Reserve</td>
                <td class="currency highlight">
                    <div>
                        {{number_format($operation_data->trust_reserve)}}
                    </div>
                </td>
                <td></td>
            </tr>
            <tr class="bold-font">
                <td>Total DST Reserves</td>
                <td class="currency">
                    <div>
                        {{number_format($operation_data->total_dst_reserves)}}
                    </div>
                </td>
                <td></td>
            </tr>
        </table>


        <div class="row border-bottom-none padding-m">
            <img src="{{asset('img/apple-touch-icon.png')}}" class="logo push-up-nav field-text">
        </div>
    </div>
</body>
</html>
