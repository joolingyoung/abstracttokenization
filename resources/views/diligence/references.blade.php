@extends('diligence.template')
@section('title', $title )

@section('body')
<form action="/diligence/references/create" method="post">
@csrf

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Account Verification</h5>
    </div>
    <div class="card-content">
        <h5>Professional References </h5>
        <p>We will need 4 references from your team. (1) Commercial Mortgage Broker, (2) Bank References, and (1) CRE Broker. </p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-form">
                            <div class="row">
                                <!-------
                                    -------------- Reference 1 -------------
                                -------->
                                <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Reference Type</p>
                                            <select name="reference_type_1">

                                                <!-- default select value -->
                                                <option value="{{ isset($data['reference_type_1']) ? $data['reference_type_1'] : '' }}" selected="selected">
                                                    @if(isset($data['reference_type_1']))

                                                    @switch($data['reference_type_1'])
                                                        @case('cre')
                                                                CRE Broker
                                                            @break

                                                        @case('cmb')
                                                            Commercial Mortgage Broker
                                                            @break

                                                        @case('bank')
                                                                Bank Reference
                                                            @break

                                                        @default

                                                    @endswitch

                                                    @else
                                                        Select an option
                                                    @endif
                                                </option>


                                                <option value="cmb">Commercial Mortgage Broker</option>
                                                <option value="cre">CRE Broker</option>
                                                <option value="bank">Bank Reference</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Full Name</p>
                                            <input type="text" value="{{ isset($data['reference_name_1']) ? $data['reference_name_1'] : '' }}" placeholder="Jane Doe" name="reference_name_1">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Phone Number</p>
                                            <input type="text" value="{{ isset($data['reference_phone_1']) ? $data['reference_phone_1'] : '' }}" placeholder="202-555-0176" name="reference_phone_1">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Email</p>
                                            <input type="text" value="{{ isset($data['reference_email_1']) ? $data['reference_email_1'] : '' }}" placeholder="jane@abstract.com" name="reference_email_1">
                                        </div>
                                    </div>
                                </div>

                                <!-------
                                    -------------- Reference 2 -------------
                                -------->

                                <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Reference Type</p>
                                            <select name="reference_type_2">

                                                <!-- default select value -->
                                                <option value="{{ isset($data['reference_type_2']) ? $data['reference_type_2'] : '' }}" selected="selected">
                                                    @if(isset($data['reference_type_2']))

                                                    @switch($data['reference_type_2'])
                                                        @case('cre')
                                                                CRE Broker
                                                            @break

                                                        @case('cmb')
                                                            Commercial Mortgage Broker
                                                            @break

                                                        @case('bank')
                                                                Bank Reference
                                                            @break

                                                        @default

                                                    @endswitch

                                                    @else
                                                        Select an option
                                                    @endif
                                                </option>

                                                <option value="cmb">Commercial Mortgage Broker</option>
                                                <option value="cre">CRE Broker</option>
                                                <option value="bank">Bank Reference</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Full Name</p>
                                            <input type="text" value="{{ isset($data['reference_name_2']) ? $data['reference_name_2'] : '' }}" placeholder="John Doe" name="reference_name_2">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Phone Number</p>
                                            <input type="text" value="{{ isset($data['reference_phone_2']) ? $data['reference_phone_2'] : '' }}" placeholder="202-555-0176" name="reference_phone_2">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Email</p>
                                            <input type="text" value="{{ isset($data['reference_email_2']) ? $data['reference_email_2'] : '' }}" placeholder="john@abstract.com" name="reference_email_2">
                                        </div>
                                    </div>
                                </div>

                                <!-------
                                    -------------- Reference 3 -------------
                                -------->

                                <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Reference Type</p>
                                            <select name="reference_type_3">

                                                <!-- default select value -->
                                                <option value="{{ isset($data['reference_type_3']) ? $data['reference_type_3'] : '' }}" selected="selected">
                                                    @if(isset($data['reference_type_3']))

                                                    @switch($data['reference_type_3'])
                                                        @case('cre')
                                                                CRE Broker
                                                            @break

                                                        @case('cmb')
                                                            Commercial Mortgage Broker
                                                            @break

                                                        @case('bank')
                                                                Bank Reference
                                                            @break

                                                        @default

                                                    @endswitch

                                                    @else
                                                        Select an option
                                                    @endif
                                                </option>

                                                <option value="cmb">Commercial Mortgage Broker</option>
                                                <option value="cre">CRE Broker</option>
                                                <option value="bank">Bank Reference</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Full Name</p>
                                            <input type="text" value="{{ isset($data['reference_name_3']) ? $data['reference_name_3'] : '' }}" placeholder="Jane Doe" name="reference_name_3">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Phone Number</p>
                                            <input type="text" value="{{ isset($data['reference_phone_3']) ? $data['reference_phone_3'] : '' }}" placeholder="202-555-0176" name="reference_phone_3">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Email</p>
                                            <input type="text" value="{{ isset($data['reference_email_3']) ? $data['reference_email_3'] : '' }}" placeholder="jane@abstract.com" name="reference_email_3">
                                        </div>
                                    </div>
                                </div>

                                <!-------
                                    -------------- Reference 4 -------------
                                -------->

                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Reference Type</p>
                                            <select name="reference_type_4">

                                                <!-- default select value -->
                                                <!-- default select value -->
                                                <option value="{{ isset($data['reference_type_4']) ? $data['reference_type_4'] : '' }}" selected="selected">
                                                    @if(isset($data['reference_type_4']))

                                                    @switch($data['reference_type_4'])
                                                        @case('cre')
                                                                CRE Broker
                                                            @break

                                                        @case('cmb')
                                                            Commercial Mortgage Broker
                                                            @break

                                                        @case('bank')
                                                                Bank Reference
                                                            @break

                                                        @default

                                                    @endswitch

                                                    @else
                                                        Select an option
                                                    @endif
                                                </option>

                                                <option value="cmb">Commercial Mortgage Broker</option>
                                                <option value="cre">CRE Broker</option>
                                                <option value="bank">Bank Reference</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Full Name</p>
                                            <input type="text" value="{{ isset($data['reference_name_4']) ? $data['reference_name_4'] : '' }}" placeholder="John Doe" name="reference_name_4">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Phone Number</p>
                                            <input type="text" value="{{ isset($data['reference_phone_4']) ? $data['reference_phone_4'] : '' }}" placeholder="202-555-0176" name="reference_phone_4">
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <p>Email</p>
                                            <input type="text" value="{{ isset($data['reference_email_4']) ? $data['reference_email_4'] : '' }}" placeholder="john@abstract.com" name="reference_email_4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <div class="footer-button-back">
                                <button type="button" onclick="window.location.href = 'principles';">Back</button>
                            </div>
                            <div class="row center-xs">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="content-footer-step">
                                        <div class="row">
                                            <div class="col-xs">
                                                <div class="step-item active"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item active"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item active"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                        </div>
                                        <div class="step-divider"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-button-next">
                                <input type="submit" value="Next">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
@endsection
