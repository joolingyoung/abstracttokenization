<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SecurityFundFlowModel;
use App\AccountVerification;
use App\User;
use App\Notifications\FundNotification;

class ForFundApprovalController extends Controller
{
    public function fundApprove(Request $request) {
        $id = $request->input('id');
        $fund = SecurityFundFlowModel::find($id);
        $fund_name = $fund->toArray()['fund-name'];
        $approval_token = $fund->approval_token;
        $status = $fund->status;
        $user_id = $fund->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();

        if( $approval_token == $request->input('token')) {
            if($status == 'Approved') {
                return view(
                    'for-approval.approved',
                    [
                        'title' => "Already Approved",
                        'info' => "This fund had already been approved."
                    ]
                );
            } else {
                $fund->status = 'Approved';
                $fund->save();
                $from_address = 'no-reply@abstracttokenization.com';
                $from_name = 'Abstract Tokenization';
                $to_address = $user->email;
                $subject = 'Offering Approved';
                $data = [
                    'comments' => "Your submission for, {$fund_name}, has been approved.
                        You can now complete the process of converting the ownership
                        into digital securities from My Properties, Approved section:
                        https://develop.abstracttokenization.com/properties/approved",
                    'link_url'=> '',
                    'link_str' => ''
                ];
                $view = 'emails.client-mail';
                sendMail($from_address, $from_name, $to_address, $subject, $data, $view);

                $user->notify(new FundNotification('approved', $fund_name));

                return view(
                    'for-approval.approved',
                    [
                        'title' => "Approved Success",
                        'info' => "{$user_name}'s {$fund_name} has been approved."
                    ]
                );
            }
        } else {
            return view(
                'for-approval.approved',
                [ 'title' => "Approval Failed", 'info' => "You don't have permission to approve fund."]
            );
        }
    }

    public function fundReject(Request $request) {
        $id = $request->input('id');
        $fund = SecurityFundFlowModel::find($id);
        $fund_name = $fund->toArray()['fund-name'];
        $reject_token = $fund->approval_token;
        $status = $fund->status;
        $user_id = $fund->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();
        if( $reject_token == $request->input('token')) {
            if($status == 'Rejected') {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Already Rejected", 'info' => "{$user_name}'s {$fund_name} had already been rejected.",
                        'type' => 'no'
                    ]
                );
            } else {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Are you going to reject {$user_name}'s {$fund_name}?", 'info' => "What is the reason?",
                        'type' => 'fundReject', 'id' => $id, 'reject_token' => $reject_token
                    ]
                );
            }
        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject fund.",
                    'type' => 'no'
                ]
            );
        }

    }

    public function fundRejected(Request $request) {

        $id = $request->get('id');
        $fund = SecurityFundFlowModel::find($id);
        $fund_name = $fund->toArray()['fund-name'];
        $reject_token = $fund->approval_token;
        $user_id = $fund->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();
        if( $reject_token == $request->get('reject_token')) {
            $fund->status = 'Rejected';
            $fund->save();
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $user->email;
            $subject = 'Offering Submission Rejected';
            $data = [
                'comments' => "Your real estate offering, , {$fund_name} has been rejected.
                    Please revise your submission from My Properties
                    https://develop.abstracttokenization.com/properties/pending
                    if incorrect data was entered, otherwise we hope to work with you on a future deal.
                    The reason(s) your submission was rejected by our investment committee are as follows:
                    {$request->get('comments')}",
                'link_url'=> '',
                'link_str' => ''
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);

            $user->notify(new FundNotification('rejected', $fund_name));

            return view(
                'for-approval.rejected',
                [
                    'title' => "Rejected Success ", 'info' => "{$user_name}'s {$fund_name} has been rejected.",
                    'type' => 'no'
                ]
            );

        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject fund.",
                    'type' => 'no'
                ]
            );
        }

    }
}
