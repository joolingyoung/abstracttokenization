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
        .pdf-row {
            border-bottom: 1px solid #dedede;
            padding-left: 20px;
        }
        .border-bottom-none {
            border: none;
        }
        .property-body{
            margin-bottom: 20px;
        }
        .each-line {
            float: left;
            width: 25%;
        }
        .big-line {
            width: 30%;
        }
        .pdf-row::after {
            content: "";
            clear: both;
            display: table;
        }
        .sub-head-title {
            font-size: 18px;
        }
        .head-bg-color {
            background-color: rgb(232, 248, 247);
        }
        .no-margin {
            margin: 0;
        }
        .padding-vertical-m {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .spec-border-bottom {
            height: 1px;
            background-color: black;
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
        .field-width {
            width: 80px;
        }
        .dollar-mark {
            display:inline-block;
        }
        .field-text {
            float: right;
        }
        .padding-m {
            padding-top: 20px;
        }
        .footer-comment {
            width: 70%;
            display:inline-block;
        }
        .report-type {
            width: 100%;
            float: right;
        }
        .small-line {
            width: 22%;
            float: left;
        }
    </style>
    
</head>
<body>
    <div class="card-body">
        <div class="pdf-row padding-vertical-m">
            <div class="border-none each-line sub-head-title">
                <img src="{{asset('img/acg-dark-logo.png')}}" class="logo push-up-nav">
            </div>
            <div class="each-line"></div>
            <div class="small-line"></div>
            <div class="each-line big-line sub-head-title bold-font">
                <p>Net Cash Flow Report</p>
            </div>
        </div>
        <div class="pdf-row padding-vertical-m bold-font">
            <div class="border-none each-line sub-head-title big-line">
                <p class="no-margin header-tip-title">Sponsor Name</p>
                <p class="no-margin header-title">{{$company_name}}</p>
            </div>
            <div class="border-none each-line hide-sm sub-head-title">
                <p class="no-margin header-tip-title">Property Name</p>
                <p class="no-margin header-title">{{$property_name}}</p>
            </div>
            <div class="border-none each-line hide-sm sub-head-title">
                <p class="no-margin header-tip-title">Report Date</p>
                <p class="no-margin header-title">{{$report_date}}</p>
            </div>
            <div class="each-line"></div>
        </div>
        <div class="pdf-row head-bg-color border-bottom-none bold-font">
            <div class="each-line sub-head-title big-line">
                <p>Cash Flow</p>
            </div>
            <div class="each-line hide-sm sub-head-title">
                <p>Current</p>
            </div>
            <div class="each-line hide-sm sub-head-title">
                <p>YTD</p>
            </div>
            <div class="each-line hide-sm sub-head-title">
                <p>Annualized</p>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Total Income</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    $<p class="field-text">{{number_format(575921)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(650332)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(650332)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Total Operating Expenses</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(175478)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(245012)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(245012)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
        </div>
        <div class="pdf-row border-bottom-none head-bg-color bold-font">
            <p class="each-line no-margin padding-vertical-m sub-head-title big-line">Net Opearting Income</p>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(400443)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(405320)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(405320)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Debt Service</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    $<p class="field-text">{{number_format(75478)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(105320)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(105320)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Interior Capital Expenditure</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    $<p class="field-text">{{number_format(50500)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(90800)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(90800)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Exterior Captial Expenditure</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    $<p class="field-text">{{number_format(40079)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(62948)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(62948)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row">
            <div class="each-line big-line">
                <p>Non-operating Expenses</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(60655)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(20300)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    <div>$<p class="field-text">{{number_format(20300)}}</p></div>
                    <div class="spec-border-bottom"></div>
                </div>
            </div>
        </div>
        <div class="pdf-row margin-bottom-m border-bottom-none head-bg-color sub-head-title bold-font">
            <div class="each-line big-line">
                <p>Net Cash Flow</p>
            </div>
            <div class="each-line current">
                <div class="field-width">
                    $<p class="field-text">{{number_format(173731)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(125952)}}</p>
                </div>
            </div>
            <div class="each-line">
                <div class="field-width">
                    $<p class="field-text">{{number_format(125952)}}</p>
                </div>
            </div>
        </div>
        <div class="pdf-row border-bottom-none">
            <img src="{{asset('img/apple-touch-icon.png')}}" class="logo push-up-nav padding-m" style="float: right;">
        </div>
    </div>
</body>
</html>