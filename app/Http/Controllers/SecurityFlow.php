<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\AccountVerification;
use App\Rules\Currency;
use App\Rules\DateParse;
use App\Rules\Percentage;

class SecurityFlow extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    public function choose () {
        $userid = Auth::id();
        $account_verification = AccountVerification::where('userid', $userid)
                ->first();
        if($account_verification && $account_verification->status == "Approved") {
            $block = "approved";
        } elseif ($account_verification && $account_verification->status != "Approved"){
            $block = "notapproved";
        } else {
            $block = "notregister";
        }
        return view( 'security-flow.step-1.choose',
            [ 'title' => 'Create Digital Security > Security Type', 'block' => $block  ] );
    }

    public function upload () {
        return view( 'security-flow.step-1.upload', [ 'title' => 'Create Digital Security > Upload Photos' ] );
    }

    public function details (Request $request) {
        return view( 'security-flow.step-1.details', [ 'title' => 'Create Digital Security > Upload Photos' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function highlights (Request $request) {
        return view( 'security-flow.step-1.highlights', [ 'title' => 'Create Digital Security > Highlights' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function ownership (Request $request) {
        return view( 'security-flow.step-2.ownership', [ 'title' => 'Create Digital Security > Ownership' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function diligence (Request $request) {
        $userid = Auth::id();
        $company = DB::table('account_verification')
            ->where('userid', $userid)
            ->select('company_name')
            ->first();
        $data = $request->session()->get('security-flow');
        return view( 'security-flow.step-3.diligence', [ 'title' => 'Create Digital Security > Ownership' ] )->with(compact('company', 'data'));
    }

    public function keyPoints (Request $request) {
        return view( 'security-flow.step-4.key-points', [ 'title' => 'Create Digital Security > Key Points' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function capitalStack (Request $request) {
        return view( 'security-flow.step-5.capital-stack', [ 'title' => 'Create Digital Security > Capital Stack' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function meetSponsors (Request $request) {
        return view( 'security-flow.step-6.meet-sponsors', [ 'title' => 'Create Digital Security > Meet the Sponsors' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function preview (Request $request) {
        return view( 'security-flow.step-7.preview', [ 'title' => 'Create Digital Security > Preview' ] )->with('data', $request->session()->get('security-flow'));
    }

    public function final (Request $request) {
        $userid = Auth::id();
        $company = DB::table('account_verification')
            ->where('userid', $userid)
            ->select('company_name')
            ->first();
        $bio = DB::table('account_verification')
            ->where('userid', $userid)
            ->value('bio');
        $data = $request->session()->get('security-flow');

        return view( 'security-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ] )->with(compact('data', 'company', 'bio'));
    }

    public function display (Request $request) {
        dd($request->session()->get('account-settings.principles'));
    }

    // Save Data into a session
    public function saveData (Request $request, $e) {

        if ($e != 'keyPoints' && $e != 'meetSponsors') {
            $session_data = session( 'security-flow', array() );
            $session_data = array_merge( $session_data, $_POST );
            session( [ 'security-flow' => $session_data ] );
        } else {
            if ($e === 'keyPoints') {
                $request->session()->put('security-flow.key-points', $request->get('key-point'));
            } else if ($e === 'meetSponsors') {
                $request->session()->put('security-flow.principles', $request->get('principles'));
            }
        }

        switch ($e) {
            case "details":
                return redirect('/security-flow/step-1/highlights');
                break;
            case "highlights":
                return redirect('/security-flow/step-2/ownership');
                break;
            case "ownership":
                return redirect('/security-flow/step-3/diligence');
                break;
            case "keyPoints":
                return ('/security-flow/step-5/capital-stack');
                break;
            case "capitalStack":
                return redirect('/security-flow/step-6/meet-sponsors');
                break;
            default:
                return redirect('/security-flow/step-1/choose');
        }
    }

    // Submit Preview Data
    public function submitPreview(Request $request) {

        $session_data = session( 'security-flow', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'security-flow' => $session_data ] );

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
            'property' => 'required',
            'opportunity_type' => 'required',
            'opportunity_description' => 'required',
            'property_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'country' => 'required',
            'vacancy_rate' => 'required',
            'current_noi' => 'required',
            'annual_cash_flow' => ['required', new Currency],
            '1031_exchange' => 'required',
            'market_value' => ['required', new Currency],
            'square_footage' => 'required',
            'property_class' => 'required',
            'total_debt' => ['required', new Currency],
            'payoff_date' => ['required', new DateParse],
            'loan-type' => 'required',
            'developed' => 'required',
            'pro-frorma-noi' => 'required',
            'distribution-frequency' => 'required',
            'equity-raise-floor-amount' => ['required', new Currency],
            'total-capital-required' => ['required', new Currency],
            'equity-raise-hard-cap' => ['required', new Currency],
            'preferred-equity' => ['required', new Percentage],
            'common-equity' => ['required', new Percentage],
            'mezzanine-debt' => ['required', new Percentage],
            'senior-debt' => ['required', new Percentage],
        ];

        $this->validate($request, $rules);

        if (!empty($request->session()->get('security-flow.key-points'))) {
            $keyPoints = $request->session()->get('security-flow.key-points');
        }

        if (!empty($request->session()->get('capRead'))) {
            $capRead = json_encode($request->session()->get('capRead'));
        } else {
            $capRead = '';
        }

        if (isset($keyPoints)) {
            $userid = Auth::id();
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
                'property' => $request->get('property'),
                'opportunity_type' => $request->get('opportunity_type'),
                'opportunity_description' => $request->get('opportunity_description'),
                'property_address' => $request->get('property_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip' => $request->get('zip'),
                'country' => $request->get('country'),
                'vacancy_rate' => $request->get('vacancy_rate'),
                'current_noi' => $request->get('current_noi'),
                'annual_cash_flow' => $request->get('annual_cash_flow'),
                '1031_exchange' => $request->get('1031_exchange'),
                'market_value' => $request->get('market_value'),
                'square_footage' => $request->get('square_footage'),
                'property_class' => $request->get('property_class'),
                'total_debt' => $request->get('total_debt'),
                'payoff_date' => $request->get('payoff_date'),
                'loan-type' => $request->get('loan-type'),
                'developed' => $request->get('developed'),
                'pro-frorma-noi' => $request->get('pro-frorma-noi'),
                'distribution-frequency' => $request->get('distribution-frequency'),
                'equity-raise-floor-amount' => $request->get('equity-raise-floor-amount'),
                'total-capital-required' => $request->get('total-capital-required'),
                'equity-raise-hard-cap' => $request->get('equity-raise-hard-cap'),
                'preferred-equity' => $request->get('preferred-equity'),
                'common-equity' => $request->get('common-equity'),
                'mezzanine-debt' => $request->get('mezzanine-debt'),
                'senior-debt' => $request->get('senior-debt'),
                'principles' => '',
                'captables' => $capRead,
                'key-points' => $keyPoints,
                'approval_token' => \Str::random(32),
                'status' => 'Approved',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            );
            // temporary disable query based on approved sponsors ->where('status', 'Approved')
            $account_verification = AccountVerification::where('userid', $userid)->first();
            $data = $request->session()->get('s3-data');
            $principal_iogos = $data['account-settings/principles-logos'];
            $principal_datas = $data['account-settings/principles'];

            // fix this
            $principals_image = [];
            foreach ($principal_datas as $item) {
                foreach ($principal_iogos as $item_logo) {
                    if ($item_logo['path'] == $item->image) {
                        $principals_image[] = $item_logo['src'];
                    }
                }
            }
            $property_images = [];
            foreach ($data['security-flow/property_images'] as $item_property) {
                if ($item_property['data']->section_id == NULL) {
                    $property_images[] = $item_property;
                }
            }
            $cap_table_link = $data['security-flow/cap-property'];
            
            $cap_table_name = DB::table('files')
                ->where('user', $userid)
                ->where('field', 'cap-property')
                ->where('section', 'security-flow-files')
                ->select('name')
                ->first();
            $request->session()->forget('s3-data');
            $id = DB::table('security_flow_property')->insertGetId($payload);
            /*
            // temporary disable query based on approved sponsors until suggested menu changes are effective

            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = getenv('MAIL_ABSTRACT_ADDRESS', 'approvals@abstracttokenization.com');
            $subject = 'Pending Property Approval';
            $view = 'emails.property-approval-admin';
            $extra_data = [ 'id' => $id, 'company-logo' => $data['account-settings/company-logo'],
                        'prisented_by' => $account_verification->bio, 'principles-logos' => $principals_image,
                        'principles' => $principal_datas, 'property-images' => $property_images,
                        'cap_table_link' => $cap_table_link, 'cap_table_name' => $cap_table_name->name
                    ];
            $email_data = array_merge( $payload, $extra_data);

            sendMail($from_address, $from_name, $to_address, $subject, $email_data, $view);
            */
            if ($request->session()->get('security-flow-files')) {
                // dd($request->session()->get('account-verification'));
                $files = $request->session()->get('security-flow-files');
                foreach ($files as $key => $value) {
                    DB::table('files')
                        ->where('section', 'security-flow-files')
                        ->where('map', $value['map'])
                        // ->where('field', $value->field)
                        ->update(['section_id' => $id]);
                }
            }
            // $request->session()->forget('security-flow-files');
            // $request->session()->forget('security-flow');
            // $request->session()->forget('capRead');
            return view( 'security-flow.step-7.final', [ 'title' => 'Security Flow -> Preview & Submit', 'success' => true ] );

        } else {
            return view( 'security-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ] )->with('data', $request->session()->get('security-flow'));
        }
    }
}
