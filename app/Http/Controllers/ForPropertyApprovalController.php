<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SecurityFlowPropertyModel;
use App\AccountVerification;
use App\User;
use App\Notifications\PropertyNotification;

class ForPropertyApprovalController extends Controller
{
    public function propertyApprove(Request $request) {
        $id = $request->input('id');
        $property = SecurityFlowPropertyModel::find($id);
        $property_name = $property->property;
        $approval_token = $property->approval_token;
        $status = $property->status;
        $user_id = $property->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();

        if( $approval_token == $request->input('token')) {
            if($status == 'Approved') {
                return view(
                    'for-approval.approved',
                    [
                        'title' => "Already Approved",
                        'info' => "This Property had already been approved."
                    ]
                );
            } else {
                $property->status = 'Approved';
                $property->save();
                $from_address = 'no-reply@abstracttokenization.com';
                $from_name = 'Abstract Tokenization';
                $to_address = $user->email;
                $subject = 'Offering Approved';
                $data = [
                    'comments' => "Your submission for, {$property_name}, has been approved.
                        You can now complete the process of converting the ownership
                        into digital securities from My Properties, Approved section:
                        https://develop.abstracttokenization.com/properties/approved",
                    'link_url'=> '',
                    'link_str' => ''
                ];
                $view = 'emails.client-mail';
                sendMail($from_address, $from_name, $to_address, $subject, $data, $view);

                $user->notify(new PropertyNotification('approved',$property_name));

                return view(
                    'for-approval.approved',
                    [
                        'title' => "Approved Success",
                        'info' => "{$user_name}'s {$property_name} property has been approved."
                    ]
                );
            }
        } else {
            return view(
                'for-approval.approved',
                [ 'title' => "Approval Failed", 'info' => "You don't have permission to approve property."]
            );
        }
    }

    public function propertyReject(Request $request) {
        $id = $request->input('id');
        $property = SecurityFlowPropertyModel::find($id);
        $property_name = $property->property;
        $reject_token = $property->approval_token;
        $status = $property->status;
        $user_id = $property->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();
        if( $reject_token == $request->input('token')) {
            if($status == 'Rejected') {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Already Rejected", 'info' => "{$user_name}'s {$property_name} had already been rejected.",
                        'type' => 'no'
                    ]
                );
            } else {
                return view(
                    'for-approval.rejected',
                    [
                        'title' => "Are you going to reject {$user_name}'s {$property_name}?", 'info' => "What is the reason?",
                        'type' => 'propertyReject', 'id' => $id, 'reject_token' => $reject_token
                    ]
                );
            }
        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject property.",
                    'type' => 'no'
                ]
            );
        }

    }

    public function propertyRejected(Request $request) {

        $id = $request->get('id');
        $property = SecurityFlowPropertyModel::find($id);
        $property_name = $property->property;
        $reject_token = $property->approval_token;
        $user_id = $property->userid;
        $user = User::find($user_id);
        $user_name = $user->getFullName();
        if( $reject_token == $request->get('reject_token')) {
            $property->status = 'Rejected';
            $property->save();
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $user->email;
            $subject = 'Offering Submission Rejected';
            $data = [
                'comments' => "Your real estate offering, , {$property_name} has been rejected.
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

            $user->notify(new PropertyNotification('rejected', $property_name));

            return view(
                'for-approval.rejected',
                [
                    'title' => "Rejected Success ", 'info' => "{$user_name}'s {$property_name} has been rejected.",
                    'type' => 'no'
                ]
            );

        } else {
            return view(
                'for-approval.rejected',
                [
                    'title' => "Reject Failed", 'info' => "You don't have permission to reject property.",
                    'type' => 'no'
                ]
            );
        }

    }
}
