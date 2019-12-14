@extends('investor-servicing.template')
@section('title', "Upload New Property > Investor Servicing")
<style>
.prop-new .content-footer{
    margin:50px 0;
}
</style>
@section('body')
@if( isset( $success ) && $success )
<temp-clear
    field="property-image"
    cook="cp1">
</temp-clear>
<popup-component
    title="Upload Complete"
    type="recurring"
    user="{{ Auth::id() }}"
    info="<h5>Thank you, your property has been uploaded. </h5><p>Please allow 48 hours for our team to review and approve. Once approved, you will receive an email with instructions on how to easily invite your investors to join and view performance reports on Abstract’s Investor Servicing portal.</p>"
    action="Got It!"
    url="/investor-servicing/choose-investment">
</popup-component>
    <script>
        localStorage.removeItem("investor_newproperty_name");
        localStorage.removeItem("investor_newproperty_address");
        localStorage.removeItem("investor_newproperty_city");
        localStorage.removeItem("investor_newproperty_state");
        localStorage.removeItem("investor_newproperty_zipcode");
        localStorage.removeItem("investor_newproperty_country");
        localStorage.removeItem("investor_newproperty_banktransfer");
    </script>
@endif
<form action="/property/create/new" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>New Upload</h5></div>
    <div class="card-content">
        <form>
            <div class="row margin-bottom-m padding-bottom-m border-bottom">
                <div class="col-xs-12">
                    <h5>Property Details:</h5>
                    <p>Fill in the below property details and upload one photo of the property.</p>
                    <div class="row margin-top-m">
                        <div class="col-xs-12 col-sm-4">
                            @if($errors->has('property_image'))
                                <br/>
                                <small class="error-small"><em>*</em> <span> {{ $errors->first('property_image') }} </span></small>
                            @endif
                            <uploads-component
                                title="Upload Property Photo"
                                type="single"
                                action="/files"
                                elname="image"
                                scope="private"
                                field="property-image"
                                multi="yes"
                                path="/property/images/"
                                map="investor-servicing-files"
                                cook="cp1">
                            </uploads-component>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <div class="content-form">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="no-margin-top">Property / Opportunity Name</p>
                                        @if($errors->has('name'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('name') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['name']) ? $data['name'] : '' }}" name="name" id="investor_newproperty_name" onkeyup="saveInputValue(this);">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p>Property Address</p>
                                        @if($errors->has('address'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('address') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['address']) ? $data['address'] : '' }}" name="address" id="investor_newproperty_address" onkeyup="saveInputValue(this);">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p>City</p>
                                        @if($errors->has('city'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('city') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['city']) ? $data['city'] : '' }}" name="city" id="investor_newproperty_city" onkeyup="saveInputValue(this);">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p>State</p>
                                        @if($errors->has('state'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('state') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['state']) ? $data['state'] : '' }}" name="state" id="investor_newproperty_state" onkeyup="saveInputValue(this);">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Zip Code</p>
                                        @if($errors->has('zipcode'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('zipcode') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['zipcode']) ? $data['zipcode'] : '' }}" name="zipcode" id="investor_newproperty_zipcode" onkeyup="saveInputValue(this);">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Country</p>
                                        @if($errors->has('country'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('country') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['country']) ? $data['country'] : '' }}" name="country" id="investor_newproperty_country" onkeyup="saveInputValue(this);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-m padding-bottom-m border-bottom">
                <div class="col-xs-12">
                    <h5>Cap Table:</h5>
                    <p>Upload your property's cap table.</p>
                    <div class="row margin-top-m">
                        <div class="col-xs-12 col-sm-4">
                            <uploads-component
                                title="Upload Cap Table"
                                type="single"
                                action="/files"
                                elname="file"
                                scope="private"
                                field="property-cap"
                                multi="no"
                                flat="yes"
                                section="captable"
                                path="/property/cap/"
                                map="investor-servicing-files">
                            </uploads-component>
                            <br/><br/><br/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <h5>Distribution History:</h5>
                    <p>Upload your distribution history data.</p>
                    <div class="col-md-3">
                        <uploads-component title="Upload History Data" type="single" action="/files" elname="file" scope="private" field="property-history" section="historictable" multi="no" path="/property/distribution/" map="investor-servicing-files">
                        </uploads-component>
                        <div class="row">
                            <br/>
                            <a class="mrg-left-cap" href="/28912SAIAS232/sample-history-distributions.xlsx" download>
                                <i class="ivu-icon ivu-icon-md-cloud-download"></i> Download historical distributions template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-m padding-bottom-m border-bottom middle-xs">
                <div class="col-xs-12 col-sm-9">
                    <p class="no-margin">Are the provided routing numbers for ACH Electronic Transaction or for wire transfer?</p>
                    @if($errors->has('bankTransfer'))
                        <small class="error-small"><em>*</em> <span> {{ $errors->first('bankTransfer') }} </span></small>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-3">
                    <select class="no-margin" name="bankTransfer" id="investor_newproperty_banktransfer" onchange="saveOptionValue(this);">
                        <option value="{{ isset($data['bankTransfer']) ? $data['bankTransfer'] : '' }}" selected="selected">{{ isset($data['bankTransfer']) ? $data['bankTransfer'] : 'Select an option' }}</option>
                        <option value="ACH">ACH</option>
                        <option value="wire">Wire Transfer</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h5>Centralized Document Storage (optional)</h5>
                    <p>This is where you can upload documents to populate into your secure central cloud storage where you will be able to access, view, download, and share your documents.
                    </p>
                    <p>Please drag and drop the documents to the area below and then move the documents to the relevant folders:</p>
                    <box-component
                        user="{{ Auth::id() }}"
                        owner="{{ !empty($company) ? $company->company_name : '' }}"
                        struc="diligence">
                    </box-component>
                </div>
            </div>
            <div class="row prop-new">
                <div class="col-xs-12">
                    <div class="content-footer">
                        <div class="row center-xs">
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</form>
@endsection
<script>
    function saveInputValue(e){
        var id = e.id;
        var val = e.value;
        localStorage.setItem(id, val);
    }
    function saveOptionValue(e){
        var id = e.id;
        var val = e.value;
        localStorage.setItem(id, val);
    }
</script>
<!-- @todo Ben -->
