@extends('subdomain.account-settings.main-template')
@section('title', "Choose Investment > Investor Servicing")

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Electronic Delivery Consent</h5></div>
    <div class="card-content">
        <h5>Electronic Consent & Appoint A Signee</h5>
        <p>Please consent to electronic delivery for approval of all investor servicing documents to be sent to you securely through the investor servicing platform.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-6">
                        <h5>CONSENT TO ELECTRONIC DELIVERY & COMMUNICATIONS</h5>
                        <div class="content-scroll">
                            <p>By selecting "I Agree" below, you agree to electronic delivery of reports, tax documents such as K-1s, distribution notices and other information through this website. You agree that we may provide electronically any and all communications we may be required to send you concerning your investment holdings as well as communication about the status and history of your account, our privacy policy and any disclosures required by federal or state law that may be provided electronically (the “Material”).
All of your tax documents, reporting and distribution notices, regardless of your indicated delivery preference, will be posted to this portal and will be available for review and download. You will receive an email when a Schedule E or K-1 is available for your review. This email will contain a link to securely access and download the document.</p>
<p>
To electronically receive and view and electronically save or print the Material, there is no special hardware or software needed beyond what is required to access this platform: (1) a personal computer with Internet access; (2) a widely-used, recent-generation web browser (for example, Google Chrome, Internet Explorer, Safari or Firefox); (3) either a printer, hard drive or other storage device. If the information you have supplied us for contacting you electronically changes, please notify us of your new contact information editing your email account address on file in the Account Settings sections. You represent that you have the hardware, software, email address and email capacities described above.</p>
<p>
You may withdraw your consent to receipt of electronic disclosures by sending us a message at hello@abstracttokenization.com. Include your account name in any such request. You have the option to receive any information that we have provided electronically in paper form at no cost to you.</p>
<p>
BY SELECTING "I AGREE" BELOW, YOU CONSENT TO ELECTRONIC DOCUMENT DELIVERY AND COMMUNICATION IN CONNECTION WITH ALL REPORTING. YOU ACKNOWLEDGE THAT YOU CAN ACCESS THE RECORDS AS DESCRIBED ABOVE, AND YOU UNDERSTAND THAT YOU MAY REQUEST A PAPER COPY OF THE RECORDS AT ANY TIME AND AT NO CHARGE.  IF YOU DO NOT GIVE YOUR CONSENT OR IF YOU DO NOT AGREE TO THE TERMS AND CONDITIONS DESCRIBED IN THIS DOCUMENT, THEN SELECT "I DO NOT AGREE" BELOW. IF YOU DO NOT INDICATE A DELIVERY PREFERENCE BELOW, YOUR DOCUMENTS WILL BE ACCESSIBLE TO YOU ELECTRONICALLY VIA THE INVESTOR PORTAL BUT WILL NOT BE SENT TO YOU UNLESS YOU CONTACT THE SPONSOR DIRECTLY..</p>
                        </div>
                        <div class="form-consent">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="checkbox">
                                    <p>I AGREE</p>
                                </div>
                                <div class="col-xs-12">
                                    <input type="checkbox">
                                    <p>I DO NOT AGREE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-offset-1 margin-top-m-md">
                        <h5>Appoint A Signee</h5>
                        <p>So we hear you can get to be pretty busy and important. We get it. Feel free to appoint an assignee to handle matters while you’re away. </p>
                        <div class="content-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Signee First Name</p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Signee Last Name</p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Signee Email</p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <div class="row center-xs">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="content-footer-step">
                                        <div class="row">
                                            <div class="col-xs">
                                                <div class="step-item active"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
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
                                <a href="/account-settings/password-two-factor" class="btn color-white">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>         
@endsection