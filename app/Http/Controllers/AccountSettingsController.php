<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\AccountVerificiation;
use App\Rules\Telephone;
use App\Rules\FullName;
use App\Rules\Currency;
use DateTime;
use Redirect;
use \PrimeTrustAPI;

class AccountSettingsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    /*******************
     * ******* Account Settings
     **************/

    public function submitPreview(Request $request) {
        $session_data = session( 'account-settings', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'account-settings' => $session_data ] );
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

        $id = DB::table('account_verification')->insertGetId($payload);

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
                DB::table('files')
                    ->where('section', 'account-verification-files')
                    ->where('map', $value['map'])
                    ->update(['section_id' => $id]);
            }
        }
        $request->session()->forget('s3-data');
        $request->session()->forget('account-verification-files');
        return view( 'account-settings.preview', [ 'title' => 'Account Settings -> Preview', 'success' => true ] );
    }

    public function wallets() {
        return view( 'account-settings.wallets', [ 'title' => 'Account Settings -> Digital Custodial Wallets' ] );
    }

    public function privacy() {
        return view( 'account-settings.privacy', [ 'title' => 'Account Settings -> Privacy & Data Storage' ] );
    }

    public function updatePrivacy(Request $request) {
        $edc = (bool) $request->input( 'edc', true );
        $signee_first = $request->input( 'signee_first_name' );
        $signee_last = $request->input( 'signee_last_name' );
        $signee_email = $request->input( 'signee_email' );

        DB::table( 'users' )
            ->where( 'id', $request->user->id )
            ->update( [
                'electronic_document_consent'   => $edc,
                'signee_first_name'             => $signee_first,
                'signee_last_name'              => $signee_last,
                'signee_email'                  => $signee_email
            ] );

        $updated_user = DB::table( 'users' )->where( 'id', $request->user->id )->distinct()->get();
        \Illuminate\Support\Facades\View::share( 'user', $updated_user[0] );

        return view( 'account-settings.privacy', [ 'title' => 'Account Settings -> Privacy & Data Storage', 'updated' => true ] );
    }

    public function passwordAnd2FA() {
        return view( 'account-settings.password', [ 'title' => 'Account Settings -> Password & 2FA' ] );
    }

    public  function updatePassword(Request $request) {
        $current_password = $request->input( 'current_password' );
        $new_password = $request->input( 'new_password' );

        if( Auth::attempt( [ 'email' => $request->user->email, 'password' => $current_password ] ) ) {
            $new_password = Hash::make( $new_password );
            DB::table( 'users' )
                ->where( 'id', $request->user->id )
                ->update( [ 'password' => $new_password ] );

            return view( 'account-settings.password', [ 'title' => 'Account Settings -> Password & 2FA', 'success' => true ] );
        } else {
            return view( 'account-settings.password', [ 'title' => 'Account Settings -> Password & 2FA', 'error' => true ] );
        }
    }

    public function exportData() {
        return view( 'account-settings.export', [ 'title' => 'Account Settings -> Export Data' ] );
    }


//  Create Account
    public function createAccount(Request $request) {
        $trust = new PrimeTrustAPI();
        $user = $request->user;
        $user_email = $user->email;
        $user_name = $user->first_name.' '.$user->last_name;
        $password = 'F@nt@st1c';
        $token_symbol = $request->post('tokenSymbol');
        $token_count = $request->post('tokenCount');
        $custody_records = $trust->getCustodyAccount($user_email);

        if ( count($custody_records) ) {
            $custody_user_id = $custody_records[0]->user_id;
        } else {
           $custody_user_id = $trust->createCustodyUser($user_email, $user_name, $password);
        }

        $jwt_token = $trust->getPrimeToken($user_email, $password);
        $custody_account_id = $trust->createCustodyAccount($user_email, $user_name, $token_symbol, $token_count, $jwt_token);
        $trust->createCustodyRecord($user_email, $custody_user_id, $token_symbol, $token_count, $custody_account_id);

        return Redirect::to('/account-settings/custody-account');
    }

//  Custody Account
    public function custodyAccount(Request $request) {
        $trust = new PrimeTrustAPI();
        $user_email = $request->user->email;

        $custody_accounts = $trust->getCustodyAccount($user_email);

        return view( 'account-settings.custody', [ 'title' => 'Account Settings -> Custody Account' ] )->with('accounts', $custody_accounts);
    }

//  Fund transfer
    public function depositFunds(Request $request) {
        $trust = new PrimeTrustAPI();
        $account_id = $request->route('id');
        $user_email = $request->user->email;
        $password = 'F@nt@st1c';
        $unit = $request->post('unit');
        $token_count = $request->post('tokenCount');
        $balance = $temp = (int)$unit * (int)$token_count;
        $jwt_token = $trust->getPrimeToken($user_email, $password);

        while($temp > 0) {
            $funds = $temp > 5000 ? 5000 : $temp;
            $contribution_id = $trust->createContribution($user_email, $account_id, $funds, $jwt_token);
            $trust->authorizeFunds($contribution_id, $funds, $jwt_token);
            $temp -= 5000;
        }
        $trust->updateCustodyRecord($account_id, $balance, $jwt_token);

        return Redirect::to('/account-settings/custody-account');
    }
    public function document() {
        return view('account-settings.document', [ 'title' => 'Account Settings -> Document Management' ] );
    }

    public function entire(Request $request) {
        $userid = Auth::id();
        $company = DB::table('account_verification')
            ->where('userid', $userid)
            ->select('company_name')
            ->first();
        $user = auth()->user();
        $data = $request->session()->get('account-settings');
        
        return view( 'account-settings.entire', [ 'title' => 'Account Settings -> Preview' ] )->with(compact('data', 'company', 'user'));
    }
}
