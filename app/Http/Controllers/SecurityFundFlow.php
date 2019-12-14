<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AccountVerification;
use App\Rules\Currency;
use App\Rules\DateParse;
use App\Rules\Percentage;
class SecurityFundFlow extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    public function choose () {
        return view( 'security-fund-flow.step-1.choose', [ 'title' => 'Create Digital Security > Security Type' ] );
    }

    public function upload () {
        return view( 'security-fund-flow.step-1.upload', [ 'title' => 'Create Digital Security > Upload Photos' ] );
    }

    public function details (Request $request) {
        return view( 'security-fund-flow.step-1.details', [ 'title' => 'Create Digital Security > Upload Photos' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function detailsno (Request $request) {
        return view( 'security-fund-flow.step-1.details-no', [ 'title' => 'Create Digital Security > Upload Photos' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function highlights (Request $request) {
        return view( 'security-fund-flow.step-1.highlights', [ 'title' => 'Create Digital Security > Highlights' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function ownership (Request $request) {
        return view( 'security-fund-flow.step-2.ownership', [ 'title' => 'Create Digital Security > Ownership' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function diligence (Request $request) {
        $userid = Auth::id();
        $company = AccountVerification::where('userid', $userid)->first();
        $data = $request->session()->get('security-fund-flow');
        return view( 'security-fund-flow.step-3.diligence', [ 'title' => 'Create Digital Security > Ownership' ] )->with(compact('company', 'userid', 'data'));
    }

    public function keyPoints (Request $request) {
        return view( 'security-fund-flow.step-4.key-points', [ 'title' => 'Create Digital Security > Key Points' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function capitalStack (Request $request) {
        return view( 'security-fund-flow.step-5.capital-stack', [ 'title' => 'Create Digital Security > Capital Stack' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function meetSponsors (Request $request) {
        return view( 'security-fund-flow.step-6.meet-sponsors', [ 'title' => 'Create Digital Security > Meet the Sponsors' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function preview (Request $request) {
        return view( 'security-fund-flow.step-7.preview', [ 'title' => 'Create Digital Security > Preview' ] )->with('data', $request->session()->get('security-fund-flow'));
    }

    public function final (Request $request) {
        $userid = Auth::id();
        $company = AccountVerification::where('userid', $userid)->first();
        $bio = DB::table('account_verification')
            ->where('userid', $userid)
            ->value('bio');
        $data = $request->session()->get('security-fund-flow');

        return view( 'security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ] )->with(compact('data', 'company', 'bio'));
    }

    // Save Data into a session
    public function saveData (Request $request, $e) {
        if ($e != 'keyPoints' && $e != 'meetSponsors') {
            $session_data = session( 'security-fund-flow', array() );
            $session_data = array_merge( $session_data, $_POST );
            session( [ 'security-fund-flow' => $session_data ] );
        } else {
            if ($e === 'keyPoints') {
                $request->session()->put('security-fund-flow.key-points', $request->get('key-point'));
            } else if ($e === 'meetSponsors') {
                $request->session()->put('security-fund-flow.principles', $request->get('principles'));
            }
        }

        switch ($e) {
            case "details":
                return redirect('/security-fund-flow/step-1/highlights');
                break;
            case "highlights":
                return redirect('/security-fund-flow/step-2/ownership');
                break;
            case "ownership":
                return redirect('/security-fund-flow/step-3/diligence');
                break;
            case "keyPoints":
                return ('/security-fund-flow/step-5/capital-stack');
                break;
            case "capitalStack":
                return redirect('/security-fund-flow/step-6/meet-sponsors');
                break;
            default:
                return redirect('/security-fund-flow/step-1/choose');
        }
    }

    // Submit Preview Data
    public function submitPreview(Request $request) {
        $userid = Auth::id();
        if (!empty($request->session()->get('security-fund-flow.key-points'))) {
            $keyPoints = $request->session()->get('security-fund-flow.key-points');
        }
        else
            $keyPoints = '';

        if (!empty($request->session()->get('capRead'))) {
            $capRead = json_encode($request->session()->get('capRead'));
        } else {
            $capRead = '';
        }
        $payload = array(
            'userid' => $userid,
            'target-investor-irr' => $request->get('target-investor-irr'),
            'investment-profile' => $request->get('investment-profile'),
            'funds-due' => $request->get('funds-due'),
            'target-equity-multiple' => $request->get('target-equity-multiple'),
            'minimum-investment' => $request->get('minimum-investment'),
            'distribution-period' => $request->get('distribution-period'),
            'target-investment-period' => $request->get('target-investment-period'),
            'property-type' => $request->get('property-type'),
            'sponsor-co-investment' => $request->get('sponsor-co-investment'),
            'target-avg-investor-cash-yield' => $request->get('target-avg-investor-cash-yield'),
            'offers-due' => $request->get('offers-due'),
            'distribution-commencement' => $request->get('distribution-commencement'),
            'fund-name' => $request->get('fund-name'),
            'opportunity-type' => $request->get('opportunity-type'),
            'type-of-fund' => $request->get('type-of-fund'),
            'capital-origin' => $request->get('capital-origin'),
            'capital-deployed' => $request->get('capital-deployed'),
            'fund-address' => $request->get('fund-address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'fund-description' => $request->get('fund-description'),
            'minimum-raise-amount' => $request->get('minimum-raise-amount'),
            'distribution-frequency' => $request->get('distribution-frequency'),
            'maximum-raise-amount' => $request->get('maximum-raise-amount'),
            'total-capital-required' => $request->get('total-capital-required'),
            'preferred-equity' => $request->get('preferred-equity'),
            'common-equity' => $request->get('common-equity'),
            'mezzanine-debt' => $request->get('mezzanine-debt'),
            'senior-debt' => $request->get('senior-debt'),
            'vacancy-rate' => $request->get('vacancy-rate'),
            'proforma-current-noi' => $request->get('proforma-current-noi'),
            'annual-cash-flow' => $request->get('annual-cash-flow'),
            '1031-exchange' => $request->get('1031-exchange'),
            'market-value' => $request->get('market-value'),
            'square-footage' => $request->get('square-footage'),
            'property-class' => $request->get('property-class'),
            'total-debt' => $request->get('total-debt'),
            'payoff-date' => $request->get('payoff-date'),
            'loan-type' => $request->get('loan-type'),
            'developed' => $request->get('developed'),
            'existing-properties' => $request->get('existing-properties'),
            'principles' => '',
            'approval_token' => \Str::random(32),
            'status' => 'Approved',
            'key-points' => $keyPoints,
            'captables' => $capRead,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        );
        if (!empty($request->get('updateflow'))) { // Update Security Fund Flow Table
            DB::table('security_fund_flow')
                ->where('userid', $userid)
                ->where('id', $request->get('updateflow'))
                ->update($payload);
                $request->session()->forget('security-fund-flow');
                $request->session()->forget('capRead');
            return view( 'security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security -> Preview & Submit', 'success' => true ] );
        } else { // Create New Security Fund Flow Column

        $session_data = session( 'security-fund-flow', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'security-fund-flow' => $session_data ] );

        // Validations
        $condRule = [];
        if ($request->get('fund-type') === 'Yes') {
            $condRule = [
                'vacancy-rate' => 'required',
                'proforma-current-noi' => 'required',
                'annual-cash-flow' => ['required', new Currency],
                '1031-exchange' => 'required',
                'market-value' => ['required', new Currency],
                'square-footage' => 'required',
                'property-class' => 'required',
                'total-debt' => ['required', new Currency],
                'payoff-date' => ['required', new DateParse],
                'loan-type' => 'required',
                'developed' => 'required'
            ];
        } else {
            $condRule = [
                'existing-properties' => 'required'
            ];
        }
        $rules = [
            'target-investor-irr' => ['required', new Percentage],
            'investment-profile' => 'required',
            'funds-due' => ['required', new DateParse],
            'target-equity-multiple' => 'required',
            'minimum-investment' => ['required', new Currency],
            'distribution-period' => 'required',
            'target-investment-period' => 'required',
            'property-type' => 'required',
            'sponsor-co-investment' => ['required', new Currency],
            'target-avg-investor-cash-yield' => ['required', new Percentage],
            'offers-due' => ['required', new DateParse],
            'distribution-commencement' => ['required', new DateParse],
            'fund-name' => 'required',
            'opportunity-type' => 'required',
            'type-of-fund' => 'required',
            'capital-origin' => 'required',
            'capital-deployed' => ['required', new Currency],
            'fund-address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'country' => 'required',
            'fund-description' => 'required',
            'minimum-raise-amount' => ['required', new Currency],
            'distribution-frequency' => 'required',
            'maximum-raise-amount' => ['required', new Currency],
            'total-capital-required' => ['required', new Currency],
            'preferred-equity' => ['required', new Percentage],
            'common-equity' => ['required', new Percentage],
            'mezzanine-debt' => ['required', new Percentage],
            'senior-debt' => ['required', new Percentage],
        ];
        $rules = array_merge( $rules, $condRule);
        $this->validate($request, $rules);
        if (isset($keyPoints)) {
            // temporary disable query based on approved sponsors ->where('status', 'Approved')
            $account_verification = AccountVerification::where('userid', $userid)->first();
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
            $fund_images = [];
            foreach ($data['security-fund-flow/fund_images'] as $item_fund) {
                if ($item_fund['data']->section_id == NULL) {
                    $fund_images[] = $item_fund;
                }
            }
            $cap_table_link = $data['security-fund-flow/fund-cap-property'];
            $cap_table_name = DB::table('files')
                ->where('user', $userid)
                ->where('field', 'fund-cap-property')
                ->where('section', 'security-fund-flow-files')
                ->select('name')
                ->first();

            $request->session()->forget('s3-data');
            $id = DB::table('security_fund_flow')->insertGetId($payload);
            /*
            // temporary disable query based on approved sponsors until suggested menu changes are effective

            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = getenv('MAIL_ABSTRACT_ADDRESS', 'approvals@abstracttokenization.com');
            $subject = 'Pending Fund Approval';
            $view = 'emails.fund-approval-admin';

            $extra_data = [ 'id' => $id, 'company-logo' => $data['account-settings/company-logo'],
                        'prisented_by' => $account_verification->bio, 'principles-logos' => $principals_image,
                        'principles' => $principal_datas, 'fund-images' => $fund_images,
                        'cap_table_link' => $cap_table_link, 'cap_table_name' => $cap_table_name->name
                    ];
            $email_data = array_merge( $payload, $extra_data);
            sendMail($from_address, $from_name, $to_address, $subject, $email_data, $view);
            */

            if ($request->session()->get('security-fund-flow-files')) {
                // dd($request->session()->get('account-verification'));
                $files = $request->session()->get('security-fund-flow-files');
                foreach ($files as $key => $value) {
                    DB::table('files')
                        ->where('section', 'security-fund-flow-files')
                        ->where('map', $value['map'])
                        // ->where('field', $value->field)
                        ->update(['section_id' => $id]);
                }
            }
            $request->session()->forget('security-fund-flow-files');
            $request->session()->forget('security-fund-flow');
            $request->session()->forget('capRead');
            return view( 'security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security -> Preview & Submit', 'success' => true ] );

        } else {
            return view('security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ])->with('data', $request->session()->get('security-fund-flow'));
        }
        }
    }
}
