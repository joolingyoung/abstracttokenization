<!DOCTYPE html>
<html>
<head>
    <title>
        sponsor approval email
    </title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459WlhyyTh89Y.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        table {
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            border:1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin: auto;
        }
        td {
            font-family: "Montserrat";
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0 10px;
            color: #283F5C;
            font-weight: 500;
        }
        .nav-logo {
            margin-left: 10px;
            line-height: 0;
            width: 100%;
            height: 90px;
            text-align: center;
        }
        .nav-logo img {
            margin: 9.5px 0;
            height: 71px;
        }
        .email-body td {
            padding: 20px 20px;
        }
        .email-button td {
           width:50%;
           text-align:center;
        }
        .footer td{
            text-align: center;
            font-size: 15px;
        }
        .footer img {
            margin: 0 5px;
            width: 25px;
        }
        span {
            font-weight:bold;
        }
        .sponsor {
            max-height: 100px;
        }
        .button {
            color: white !important;
            padding: 11px 18px;
            font-size: 16px;
            font-weight:bold;
            border: none;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            line-height: 18px;
            cursor: pointer;
            border-radius: 4px;
        }
        .approve {
            width: 70px;
            background: #2C75E7;
        }
        .reject {
            width: 70px;
            background: #E72C2C;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td class="nav-logo" colspan="2">
                <a href="http://www.abstracttokenization.com/"><img src="http://develop.abstracttokenization.com/img/logo-dark-w-type.png" class="logo" alt="ACG"></a>
            </td>
        </tr>
        @yield('content')
    </table>

</body>

</html>
