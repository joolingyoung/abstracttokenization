<!DOCTYPE html>
<html>
<head>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    <link href="{{ public_path('css/index.css') }}"/>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
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
        .col-4 {
            display: block;
            float: left;
            width: 33%;
            min-height: 10px;
        }
        .col {
            display: block;
            float: left;
            width: 25%;
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
        .footer-comment {
            width: 70%;
            display:inline-block;
        }
        .chart {
            width: 400px;
            height: 500px;
        }
        .section {
            width: 49%;
            overflow:hidden;
        }
        .section:first-child {
            border-right: 1px solid #dedede
        }
        /* #bar_chart {
            float: left;
        }
        #line_chart {
            float: right;
        } */
        table {
            width: 100%;
            text-align: center;
        }
        td {
            width: 33%;
        }
        .margin-left-s {
            margin-left: 100px;
        }
        .margin-left-m {
            margin-left: 80px;
        }
        .padding-right-m {
            margin-right: 150px;
        }

    </style>

</head>
<body onload="init()">
    <div class="card-body">
        <div class="row middle-xs padding-vertical-m">
            <div class="border-none col-4">
                <img src="{{asset('img/acg-dark-logo.png')}}" class="logo push-up-nav">
            </div>
            <div class="col-4"></div>
            <div class="col-4 sub-head-title bold-font">
                <p>Cash Distributions Summary</p>
            </div>
        </div>
        <div class="row middle-xs padding-vertical-m bold-font">
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

        <div class="row padding-vertical-m border-bottom-none" style=" padding-left: 0px; display: -webkit-box; text-align: center">
            <div class="section">
                <p class="bold-font">Current</p>
                <table>
                    <tr>
                        <td>
                            <p>Distribution</p>
                        <p class="header-title bold-font">${{number_format($current_cash_flow)}}</p>
                        </td>
                        <td>
                            <p>Annualized</p>
                            <p class="header-title bold-font">{{number_format($current_annualized, 2)}}%</p>
                        </td>
                        <td>
                            <p>Pre-Tax Annualized</p>
                            <p class="header-title bold-font">{{number_format($current_pre_tax_annualized, 2)}}%</p>
                        </td>
                    </tr>
                </table>
                <p class="bold-font">Distributions Received</p>
                <div id="bar_chart" class="chart" style="margin-left: 30px"></div>
            </div>
            <div class="section">
                <p class="bold-font">Cumulative</p>
                <table>
                    <tr>
                        <td>
                            <p>Distribution</p>
                            <p class="header-title bold-font">${{number_format($cumulative_cash_distribution)}}</p>
                        </td>
                        <td>
                            <p>Annualized</p>
                            <p class="header-title bold-font">{{number_format($cumulative_annualized, 2)}}%</p>
                        </td>
                        <td>
                            <p>Pre-Tax Annualized</p>
                            <p class="header-title bold-font">{{number_format($pre_tax_annualized_return, 2)}}%</p>
                        </td>
                    </tr>
                </table>
                <p class="bold-font">Cumulative Return</p>
                <div id="line_chart" class="chart" style="margin-left: 60px"></div>
            </div>
        </div>
        <div class="row border-bottom-none">
            <img src="{{asset('img/apple-touch-icon.png')}}" class="logo push-up-nav padding-m" style="float: right;">
        </div>
    </div>
</body>
<script>
    function init() {
        google.load("visualization", "1.1", {
            packages: ["bar", "corechart"],
            callback: 'drawCharts'
        });
    }

    function drawCharts() {
        var barChartData = new google.visualization.arrayToDataTable({!!json_encode($distribution_array)!!});

        var barChartOptions = {
            width: 400,
            legend: { position: 'none' },
            axes: {
                x: {
                    0: { side: 'bottom', label: ''} // Top x-axis.
                }
            },
            series: { 0: {color: '#112846'} },
            bar: { groupWidth: "90%" }
        };

        var barChart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        barChart.draw(barChartData, barChartOptions);

        var lineChartData = google.visualization.arrayToDataTable({!!json_encode($cumulative_array)!!});

        var lineChartOptions = {
            width: 400,
            series: { 0: {color: '#30e900'} },
            legend: { position: 'none' }
        };

        var lineChart = new google.visualization.LineChart(document.getElementById('line_chart'));

        lineChart.draw(lineChartData, lineChartOptions);
    }
</script>
</html>
