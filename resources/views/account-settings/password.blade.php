@extends('account-settings.template')
@section('title', $title )

@section('body')
<form action="/account-settings/password" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Password & Two Factor Authentication</h5>
    </div>
    <div class="card-content">
        <h5>Update Your Security Details</h5>
        <p>Two-factor authentication is coming soon!</p>
        @if( isset( $success ) && $success )
            <div class="success"><p><strong>Your changes have been saved!</strong></p></div>
        @endif

        @if( isset( $error ) &&  $error )
            <div class="error"><p><strong>Your current password is incorrect.</strong></p></div>
        @endif
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h5>Password Update:</h5>
                        <div class="content-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Current Password</p><input type="password" name="current_password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>New Password</p><input type="password" name="new_password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Confirm New Password</p><input type="password" namee="confirm_new_password">
                                </div>
                            </div>
                            <div class="row"><input type="submit" value="Save"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 margin-top-m-sm">
                        <h5>Two Factor Authentication:</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
