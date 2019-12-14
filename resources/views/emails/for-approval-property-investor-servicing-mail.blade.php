<!DOCTYPE html>
<html lang="en-US">
    <head>
        <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                font-weight: 700;
                padding: 12px 16px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                border-radius: 3px;
                cursor: pointer;
            }

            .button-pre:hover {
                background-color: white;
                color: #186fc9 !important;
                border: 2px solid #186fc9;
            }

            .button-pre {
                background-color: #186fc9;
                color: white !important;
            }

            .button-danger:hover {
                background-color: white;
                color: #f44336 !important;
                border: 2px solid #f44336;
            }

            .button-danger {
                background-color: #f44336;
                color: white !important;
            }

        </style>
    </head>
    <body>
        <div class="card margin-top-m">
            <div class="card-title blue">
                <div class="card-content">
                    <div class="card grey margin-bottom-m margin-top-m">
                        <div class="card-content">
                        <div class="content-form">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="no-margin-top">Property / Opportunity Name:
                                            {{ isset($data['name']) ? $data['name'] : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p>Property Address:
                                       {{ isset($data['address']) ? $data['address'] : '' }}
                                       </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p>City:
                                        {{ isset($data['city']) ? $data['city'] : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p>State:
                                        {{ isset($data['state']) ? $data['state'] : '' }}
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Zip Code:
                                        {{ isset($data['zipcode']) ? $data['zipcode'] : '' }}
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Country:
                                        {{ isset($data['country']) ? $data['country'] : '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{$host}}/investor/approve?id=<?= $data['id']?>&token=erere" class="button button-pre">Approve</a>
        <!-- <a href="{{$host}}/investor/reject?id=<?= $data['id']?>&token=erere" class="button button-danger">Reject</a> -->
    </body>
</html>
