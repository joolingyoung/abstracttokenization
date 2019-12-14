<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\AccountVerification;
use App\User;
use App\Notifications\AccountSettingsNotification;

class ForApprovalController extends Controller {

    public function __construct() {
    }

    public function sponsorApprove(Request $request) {
        $id = $request->input('id');
        $account_verification = AccountVerification::find($id);
        $approval_token = $account_verification->approval_token;
        $user_name = $account_verification->getFullName();
        $status = $account_verification->status;

        if( $approval_token == $request->input('token')) {
            if($status == 'Approved') {
                return view(
                    'for-approval.approved',
                    [
                        'title' => "Already Approved",
                        'info' => "{$user_name} had already been approved."
                    ]
                );
            } else {
                $account_verification->status = 'Approved';
                $account_verification->save();
                $from_address = 'no-reply@abstracttokenization.com';
                $from_name = 'Abstract Tokenization';
                $to_address = $account_verification->email;
                $subject = 'Sponsor Approved';
                $data = [
                    'comments' => "Congratulations, you have been approved as a Sponsor on Abstract's platform.
                        You are now able to add info and upload documents for a specific property
                        or fund for which you want to Create a Digital Security.",
                    'link_url'=> 'https://develop.abstracttokenization.com/security-flow/step-1/choose',
                    'link_str' => 'Create a Digital Security'
                ];
                $view = 'emails.client-mail';
                sendMail($from_address, $from_name, $to_address, $subject, $data, $view);

                $user = User::find($account_verification->userid);
                $user->notify(new AccountSettingsNotification('approved'));

                return view(
                    'for-approval.approved',
                    [
                        'title' => "Approved Success",
                        'info' => "{$user_name} has been approved as a Sponsor on Abstract's platform."
                    ]
                );
            }
        } else {
            return view(
                'for-approval.approved',
                [ 'title' => "Approval Failed", 'info' => "You don't have permission to approve {$user_name}."]
            );
        }
    }

    public function sponsorReject(Request $request) {
        $id = $request->input('id');
        $account_verification = AccountVerification::find($id);
        $reject_token = $account_verification->approval_token;
        $user_name = $account_verification->getFullName();
        $status = $account_verification->status;
        if( $reject_token == $request->input('token')) {
            if($status == 'Rejected') {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Already Rejected", 'info' => "{$user_name} had already been rejected.",
                        'type' => 'no'
                    ]
                );
            } else {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Are you going to reject {$user_name}?", 'info' => "What is the reason?",
                        'type' => 'reject', 'id' => $id, 'reject_token' => $reject_token
                    ]
                );
            }
        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject {$user_name}.",
                    'type' => 'no'
                ]
            );
        }

    }

    public function sponsorRejected(Request $request) {

        $id = $request->get('id');
        $account_verification = AccountVerification::find($id);
        $reject_token = $account_verification->approval_token;
        $user_name = $account_verification->getFullName();
        $status = $account_verification->status;
        if( $reject_token == $request->get('reject_token')) {
            $account_verification->status = 'Rejected';
            $account_verification->save();
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $account_verification->email;
            $subject = 'Submission Rejected';
            $data = [
                'comments' => $request->get('comments'),
                'link_url'=> 'https://develop.abstracttokenization.com/account-settings/verification',
                'link_str' => 'Account Verification'
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);

            $user = User::find($account_verification->userid);
            $user->notify(new AccountSettingsNotification('rejected'));

            return view(
                'for-approval.rejected',
                [
                    'title' => "Rejected Success ", 'info' => "{$user_name} has been rejected.",
                    'type' => 'no'
                ]
            );

        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject {$user_name}.",
                    'type' => 'no'
                ]
            );
        }

    }

}
