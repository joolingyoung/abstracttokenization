<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\AccountVerification;
use App\Files;
use App\Rules\Telephone;
use App\Rules\FullName;
use App\Rules\Currency;
use DateTime;
use Redirect;

class DiligenceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    /*******************
     * ******* Sponsor Diligence
     **************/

    public function verification(Request $request) {
        $user = auth()->user();
        $data = $request->session()->get('diligence');
        return view( 'diligence.verify', [ 'title' => 'Sponsor Diligence -> Account Verification'] )->with(compact('data', 'user'));
    }

    public function createVerification(Request $request) {
        $session_data = session( 'diligence', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'diligence' => $session_data ] );

        return redirect('/diligence/bio');
    }

    public function bio(Request $request) {
        return view( 'diligence.bio', [ 'title' => 'Sponsor Diligence -> Sponsor Bio'] )->with('data', $request->session()->get('diligence'));
    }

    public function createBio(Request $request) {
        $session_data = session( 'diligence', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'diligence' => $session_data ] );

        return redirect('/diligence/principles');
    }

    public function principles(Request $request) {
        return view( 'diligence.principles', [ 'title' => 'Sponsor Diligence -> Meet The Principles'] )->with('data', $request->session()->get('diligence'));
    }

    public function references(Request $request) {
        return view( 'diligence.references', [ 'title' => 'Sponsor Diligence -> Professional References' ] )->with('data', $request->session()->get('diligence'));
    }

    public function createReferences(Request $request) {

        $session_data = session( 'diligence', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'diligence' => $session_data ] );

        return redirect('/diligence/documents');
    }

    public function diligence(Request $request) {
        $userid = Auth::id();
        $company = AccountVerification::select('company_name')->where('userid', $userid)->first();
        $data = $request->session()->get('diligence');

        return view( 'diligence.documents', [ 'title' => 'Sponsor Diligence -> Sponsor Diligence' ] )->with(compact('data', 'company'));
    }

    public function createDiligence(Request $request) {
        $session_data = session( 'diligence', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'diligence' => $session_data ] );
        return redirect('/diligence/preview');
    }

    /*******************
     * ******* Preview
     **************/
    public function preview(Request $request) {
        $userid = Auth::id();
        $company = AccountVerification::select('company_name')->where('userid', $userid)->first();
        $data = $request->session()->get('diligence');
        return view( 'diligence.preview', [ 'title' => 'Sponsor Diligence -> Preview' ] )->with(compact('data', 'company'));
    }


    public function submitPreview(Request $request) {
        $session_data = session( 'diligence', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'diligence' => $session_data ] );
        $telephone = new Telephone;

        $this->validate($request, [
            'company_name' => 'required',
            'company_website' => 'required',
            'first_name' => 'required',
            'work_phone' => ['required', new Telephone],
            'company_address' => 'required',
            'last_name' => 'required',
            'mobile' => ['required', new Telephone],
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'email' => 'required|email',
            'job_title' => 'required',
            'tin' => 'required',
            'country' => 'required',
            'bio' => 'required',
            'portfolio_activity_amount' => ['required', new Currency],
            'assets_under_management' => ['required', new Currency],
            'square_feet_managed' => 'required',
            'reference_type_1' => 'required',
            'reference_name_1' => ['required', new FullName],
            'reference_phone_1' => ['required', new Telephone],
            'reference_email_1' => 'required|email',
            'reference_type_2' => 'required',
            'reference_name_2' => ['required', new FullName],
            'reference_phone_2' => ['required', new Telephone],
            'reference_email_2' => 'required|email',
            'reference_type_3' => 'required',
            'reference_name_3' => ['required', new FullName],
            'reference_phone_3' => ['required', new Telephone],
            'reference_email_3' => 'required|email',
            'reference_type_4' => 'required',
            'reference_name_4' => ['required', new FullName],
            'reference_phone_4' => ['required', new Telephone],
            'reference_email_4' => 'required|email'
        ]);
        $userid = Auth::id();
        $payload = array(
            'userid' => $userid,
            'company_name' => $request->get('company_name'),
            'company_website' => $request->get('company_website'),
            'first_name' => $request->get('first_name'),
            'work_phone' => $request->get('work_phone'),
            'company_address' => $request->get('company_address'),
            'last_name' => $request->get('last_name'),
            'mobile' => $request->get('mobile'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'tin' => $request->get('tin'),
            'country' => $request->get('country'),
            'bio' => $request->get('bio'),
            'portfolio_activity_amount' => $request->get('portfolio_activity_amount'),
            'assets_under_management' => $request->get('assets_under_management'),
            'square_feet_managed' => $request->get('square_feet_managed'),
            'reference_type_1' => $request->get('reference_type_1'),
            'reference_name_1' => $request->get('reference_name_1'),
            'reference_phone_1' => $request->get('reference_phone_1'),
            'reference_email_1' => $request->get('reference_email_1'),
            'reference_type_2' => $request->get('reference_type_2'),
            'reference_name_2' => $request->get('reference_name_2'),
            'reference_phone_2' => $request->get('reference_phone_2'),
            'reference_email_2' => $request->get('reference_email_2'),
            'reference_type_3' => $request->get('reference_type_3'),
            'reference_name_3' => $request->get('reference_name_3'),
            'reference_phone_3' => $request->get('reference_phone_3'),
            'reference_email_3' => $request->get('reference_email_3'),
            'reference_type_4' => $request->get('reference_type_4'),
            'reference_name_4' => $request->get('reference_name_4'),
            'reference_phone_4' => $request->get('reference_phone_4'),
            'reference_email_4' => $request->get('reference_email_4'),
            'approval_token' => \Str::random(32),
            'status' => 'Pending',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        );

        $data = $request->session()->get('s3-data');
        $principal_iogos = $data['account-settings/principles-logos'];
        $principal_datas = $data['account-settings/principles'];
        $principals_image = [];
        foreach ($principal_datas as $item) {
            foreach ($principal_iogos as $item_logo) {
                if ($item_logo['path'] == $item->image) {
                    $principals_image[] = $item_logo['src'];
                }
            }
        }

        $id = AccountVerification::create($payload)->id;
    
        // send mail to abstract for approval
        $from_address = 'no-reply@abstracttokenization.com';
        $from_name = 'Abstract Tokenization';
        $to_address = 'approvals@abstracttokenization.com';
        $subject = 'Pending Sponsor Approval';
        $view = 'emails.account-approval-admin';
        $extra_data = [ 'id' => $id, 'company-logo' => $data['account-settings/company-logo'],
                        'principles-logos' => $principals_image,
                        'principles' => $principal_datas,
                    ];
        $email_data = array_merge( $payload, $extra_data);

        sendMail($from_address, $from_name, $to_address, $subject, $email_data, $view);

        if ($request->session()->get('account-verification-files')) {
            $files = $request->session()->get('account-verification-files');
            foreach ($files as $key => $value) {
                Files::where(['section' => 'account-verification-files', 'map' => $value['map']])->update(['section_id' => $id]);
            }
        }
        $request->session()->forget('s3-data');
        $request->session()->forget('account-verification-files');
        return view( 'diligence.preview', [ 'title' => 'Sponsor Diligence -> Preview', 'success' => true ] );
    }
}
