<!DOCTYPE html>
<html>

<head>
    <title>Abstract</title>
    <meta http-eqiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" href="/css/lib/bootstrap.css">
    <link rel="stylesheet" href="/css/lib/flexboxgrid.css">
    <link rel="stylesheet" href="/css/lib/jquery-ui.css">
    <link rel="stylesheet" href="/css/lib/cs-select.css">
    <link rel="stylesheet" href="/css/lib/owl.theme.css">
    <link rel="stylesheet" href="/css/lib/owl.carousel.css">
    <link rel="stylesheet" href="/css/lib/modal-video.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/sectionscroll.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/videopopup.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="navbar">
                <div class="row middle-xs no-margin">
                    <div class="col-xs-12 col-sm-4">
                        <div class="nav-logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a></div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="header-toggle text-center">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="header-toggle-item">
                                        <p>Investors</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="header-toggle-item active">
                                        <p>Sponsors</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="header-toggle-item">
                                        <p>Marketplace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="nav-user-info">
                            <div class="user-setting">
                                <div class="dropdown">
                                    <div data-toggle="dropdown" class="dropdown-toggle">
                                        <div class="user-image"><img src="/img/icon-user.svg"></div>
                                        <div class="user-setting-arrow"></div>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a href="/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="nav-item">
                            <div class="nav-notification"><img src="/img/icon-bell.svg"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-mobile">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a></div>
                        <div class="menu-button"><img src="/img/icon-menu-btn.svg"></div>
                        <ul class="nav-item">
                            <li><a href="#">Investor </a></li>
                            <li><a href="#">Sponsors</a></li>
                            <li><a href="#">Marketplace</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <style>
        header {
            display: none !important
        }

        body {
            background: white
        }
        .btn-dark-update{
            background: linear-gradient(135deg,#283f5c 0%,#153255 100%) !important;
        }
    </style>
    <div class="landing-wrapper">
        <div class="landing-header">
            <div class="container-fluid">
                <div class="navbar">
                    <div class="row middle-xs no-margin">
                        <div class="col-xs-12 col-sm-8">
                            <div class="nav-logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 last-xs">
                            <ul class="nav-item margin-right-s">
                                <li><a href="/login">Login</a></li>
                                <li>
                                    <div class="btn btn-dark-update"><a href="/register" style="text-decoration: none; color: #fff;">Sign Up</a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="navbar-mobile">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a></div>
                            <div class="menu-button"><img src="/img/icon-menu-btn.svg"></div>
                            <ul class="nav-item">
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Sign Up</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="hero-content">
                            <h1>BLOCKCHAIN AND AUTOMATION FOR<div class="blue">COMMERCIAL REAL ESTATE</div>
                            </h1>
                            <h3>ABSTRACT BRINGS LIQUIDITY AND EFFICIENCY TO YOUR REAL ESTATE INVESTORS.</h3>
                        </div>
                        <div class="btn margin-top-m margin-bottom-s gold"><a href="/register">Get Started</a></div>
                        <p>Voted Best ‘Blockchain Company’ by CRETech December ’18.</p>
                    </div>
                </div>
                <div class="hero-video"><a href="javascript:void(0)" id="video1">
                        <h5>Discover Abstract</h5><img src="/img/icon-video.svg">
                    </a></div>
                <div id="vidBox">
                    <div id="videCont"><iframe
                            src="https://player.vimeo.com/video/290852869?byline=0&amp;portrait=0&amp;autoplay=1"
                            style="position:absolute;top:0;left:0;width:100%;height:100%" frameborder="0"
                            webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe></div>
                </div>
            </div>
        </section>
        <section class="site-description">
            <div class="container text-center">
                <p class="no-margin">Abstract leverages blockchain technology to convert an existing property, fund
                    ownership, or new investor capital, into tradeable digital securities that enable investors to
                    access efficient secondary market liquidity after one year.</p>
            </div>
        </section>
        <section class="investor-service-platform">
            <div class="section-title">
                <h5>How It Works</h5>
            </div>
            <div class="container">
                <div class="text-center margin-bottom-l">
                    <p>We develop time and cost saving workflows for Real Estate Sponsors & Investors with our Investor
                        Servicing Portal, Primary Issuance Platform, & Marketplace.</p>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="service-card-top"><img src="/img/icon-stat-board.svg" class="center-middle"></div>
                        <div class="service-card-bottom">
                            <p>Investor Servicing Platform</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="service-card-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Portfolio Snapshot- A simplified view of your real estate holdings with total
                                        performance & distributions summaries. No need to wade thru 40 pages to find the
                                        details that truly matter.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Performance & Distributions Overview- See cumulative & annual return, history of
                                        distribution amounts, yield, ownership percentage, occupancy and more!</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Reporting- Receive the most recent operational & performance reports in simple to
                                        understand monthly, quarterly, semi-annual and/or annual investor reports.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Secure file storage - easily manage all your investment reporting and tax
                                        documents thru Abstract’s Box.com API integration.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cost-time">
            <div class="section-title">
                <h5>Cost & Time Saving Functionality</h5>
            </div>
            <div class="container">
                <div class="row middle-xs">
                    <div class="col-xs-12 col-sm-2 text-center"><img src="/img/icon-user-etting-blue.svg"></div>
                    <div class="col-xs-12 col-sm-10">
                        <p>Cap Table Management - Add or remove investors, view and download current list of investors &
                            corresponding ownership.</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="col-xs-12 col-sm-2 text-center"><img src="/img/icon-view-details.svg"></div>
                    <div class="col-xs-12 col-sm-10">
                        <p>Investor Tax Documents - Upload your Partnership Level Schedule K-1 for example, with totals
                            for your organization, and Abstract will generate & populate each investor specific K-1.</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="col-xs-12 col-sm-2 text-center"><img src="/img/icon-document-2.svg"></div>
                    <div class="col-xs-12 col-sm-10">
                        <p>Generate Standardized Reports - Use our platform to generate succinct and clear monthly,
                            quarterly, semi-annual and/or annual investor reports based on your reporting period.</p>
                    </div>
                </div>
                <div class="row middle-xs">
                    <div class="col-xs-12 col-sm-2 text-center"><img src="/img/icon-investment-blue.svg"></div>
                    <div class="col-xs-12 col-sm-10">
                        <p>Distribution Processing- Save your accountants time! We handle the calculation of each
                            investor’s distribution amount based on their investment date, ownership amount, total
                            distribution amount for the period and other relevant factors. We utilize your bank’s 3rd
                            Party Integration API to seamlessly upload the distribution ACH batch details to your
                            account.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="image-text check-mark-p">
            <div class="section-title">
                <h5>Blockchain Technology & Digital Securities Defined</h5>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="card landing">
                            <div class="card-title blue">
                                <h5>Blockchain Technology</h5>
                            </div>
                            <div class="card-content">
                                <div class="first-paragraph">
                                    <p>Enables increased efficiency, automation, and liquidity, bringing CRE to the
                                        digital age of modern finance.</p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>New pools of global capital, DLT enables scaling up number of investors on
                                            cap table at lower mins.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Regulated trading platforms provide 24/7 liquidity at lower trading costs &
                                            faster settlement.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Cryptographically secured immutable ledger prevents fraud & provides complete
                                            audit trail.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Cryptographically secured immutable ledger prevents fraud & provides complete
                                            audit trail.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Cryptographically secured immutable ledger prevents fraud & provides complete
                                            audit trail.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="image-box"><img src="/img/img-demo-1.jpg"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="image-text">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="image-box"><img src="/img/img-demo-4.jpg"></div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="row margin-bottom-m">
                            <div class="col-xs-12">
                                <div class="card landing">
                                    <div class="card-content">
                                        <h5>What is Tokenization?</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis
                                            laoreet bibendum. Aenean mattis sapien felis, viverra fringilla tellus
                                            ultrices nec.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card blue">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2 border-right">
                                                <div class="verticle-text">
                                                    <h5>How it works</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-10">
                                                <p class="padding-left-m-lg">The process involves writing of custom
                                                    smart contracts as well as securities laws compliant token
                                                    structuring, minting and distributing digital securities. This is
                                                    recorded to the blockchain’s distributed ledger for immutable record
                                                    keeping of a tamper proof, auditable data trail. Digital securities
                                                    also allow for a real time cap table of investors with automated
                                                    reporting and distribution processing.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="image-text check-mark-p dust">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="card landing">
                            <div class="card-title dust">
                                <h5>Compliant Securities</h5>
                            </div>
                            <div class="card-content">
                                <div class="first-paragraph">
                                    <p>Enables increased efficiency, automation, and liquidity, bringing CRE to the
                                        digital age of modern finance.</p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>New pools of global capital, DLT enables scaling up number of investors on
                                            cap table at lower mins.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Regulated trading platforms provide 24/7 liquidity at lower trading costs &
                                            faster settlement.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>Cryptographically secured immutable ledger prevents fraud & provides complete
                                            audit trail.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="image-box"><img src="/img/img-demo-5.jpg"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta text-center">
            <h5 class="margin-bottom-m">Digitizing Commercial Real Estate Investment. Your real estate tokenization
                experience begins here.</h5>
            <h2>WE ARE ABSTRACT.</h2>
        </section>
        <footer class="text-center">
            <p>Join our conversation:</p>
            <ul>
                <li><a href="https://www.facebook.com/AbstractTokenization" target="_blank"><img
                            src="/img/logo-facebook.svg"></a></li>
                <li><a href="https://twitter.com/abstractToken" target="_blank"><img src="/img/logo-twitter.svg"></a>
                </li>
                <li><a href="https://www.instagram.com/abstracttokenization/" target="_blank"><img
                            src="/img/logo-instagram.svg"></a></li>
                <li><a href="mailto:hello@abstracttokenization.com" target="_blank"><img src="/img/logo-email.svg"></a>
                </li>
            </ul>
            <p>© Abstract Tokenization 2019</p><a href="/img/AbstractPrivacyPolicy.pdf" target="_blank">Privacy
                Policy</a>
        </footer>
    </div>
</body>

</html>