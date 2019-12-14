<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Property;
use App\User;

class SubInvestorServicingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    public function choose(Request $request) {
        $userid = Auth::id();
        // First, fetch all of my investments.
        $my_investments = DB::table( 'investments' )
            ->where( 'userid', $userid )
            ->pluck('property_id');

        // Now, fetch each property that matches
        // @TODO support more than just the property table
        $data = Property::whereHas('investments', function($query) use ($userid){
            $query->where('userid', $userid);
        })->get();

        return view( 'subdomain.investor-servicing.choose.investment', [ 'title' => 'Choose Investment > Investor Servicing'] )->with(compact('data', 'userid'));
    }

    public function taxGenerate (Request $request, $type, $rand, $id) {
        // @todo Tax generation function
        return redirect('/investor-servicing/choose-investment');
    }

    public function reportsGenerate (Request $request, $type, $rand, $id) {
        // @todo Report generation function
        return redirect('/investor-servicing/choose-investment');
    }

    public function ownership(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);

            return view( 'subdomain.investor-servicing.cap.table', [ 'title' => 'Cap Table Management > Investor Servicing'] )->with(compact('data'));
        }

    }

    public function tax(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);
            return view( 'subdomain.investor-servicing.tax.index', [ 'title' => 'Tax Documents > Investor Servicing'] )->with(compact('data', 'type', 'id'));
        } else {
            return redirect('/investor-servicing/choose-investment');
        }

    }

    public function reports(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);

            if ($type === 'sproperty') {

                $report_data = DB::table('reports')
                ->where('parent', $id)
                ->where('type', $type)
                ->select('userid', 'quater', 'month', 'year', 'id')
                ->get();
            }
            return view( 'subdomain.investor-servicing.reports.index', [ 'title' => 'Reports > Investor Servicing'] )->with(compact('data', 'type', 'id', 'report_data'));
        } else {
            return redirect('/investor-servicing/choose-investment');
        }
    }

    public function trade(Request $request, $type, $rand, $id) {
        return view( 'subdomain.investor-servicing.trade.index', [ 'title' => 'Trade > Investor Servicing'] )->with(compact('type', 'id'));
    }

    public function investorInfo(Request $request) {
        return view( 'subdomain.account-settings.investor-info.index', [ 'title' => 'Investor Information > Investor Servicing'] );
    }

    public function bank(Request $request) {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if($user->site_id === 1) //Spnosor Flow Bank Account Details
            return view('account-settings.bank', [ 'title' => 'Bank Account > Investor Servicing'] );
        else // Investor Flow Bank Account Details
            return view( 'subdomain.account-settings.bank-account.index', [ 'title' => 'Bank Account > Investor Servicing'] );
    }

    public function consent(Request $request) {
        return view( 'subdomain.account-settings.electronic-consent.index', [ 'title' => 'Bank Account > Investor Servicing'] );
    }

    public function password(Request $request) {
        return view( 'subdomain.account-settings.password.index', [ 'title' => 'Bank Account > Investor Servicing'] );
    }

    public function dst() {
        return view( 'subdomain.investor-servicing.dst.index', [ 'title' => 'Reports > Investor Servicing'] );
    }

    public function final (Request $request) {
        $userid = Auth::id();
        $bio = DB::table('account_verification')
            ->where('userid', $userid)
            ->value('bio');
        $data = $request->session()->get('security-flow');

        return view( 'security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ] )->with(compact('data', 'bio'));
    }
}
