<?php
namespace App\Http\Controllers;

use App\CashDistributionSummary;
use App\Distribution;
use App\DistributionHistory;
use App\DstReport;
use App\OperationHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Property;
use App\Jobs\DelayMail;
use App\Notifications\GeneralDelayNotification;
use App\Investment;
use App\Report;
use App\PropertyFinancialHighlight;
use Illuminate\Support\Carbon;
use PDF;
use Browser;


class InvestorServicingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }


    public function k1() {
        return view( 'investor-servicing.investor-K-1.index', [ 'title' => 'K1 > Investor Servicing'] );
    }
    public function choose(Request $request) {
        $userid = Auth::id();

        if( $request->site->id == 1 ) {
            // @TODO support more than just the property table
            $data = Property::where( 'userid', $userid )
                ->get();
        } else {
            // First, fetch all of my investments.
            $my_investments = Investment::where( 'userid', $userid )
                ->pluck('property_id');

            // Next, determine which are visible on this microsite.
            $valid_microsite_sponsors = DB::table('microsite_sponsors' )
                ->select( 'sponsorid' )
                ->where( 'siteid', $request->site->id )
                ->pluck( 'sponsorid' );

            // Now, fetch each property that matches
            // @TODO support more than just the property table
            $data = Property::whereIn('userid', $valid_microsite_sponsors)
                ->whereIn('id', $my_investments)
                ->get();

        }
        /* Mobile Detection
        $agent = new \Jenssegers\Agent\Agent;
        $isMobile = $agent->isMobile();
        */
        //Browser Detection
        if (Browser::isChrome())
            $browser = 'Safari';
        else if(Browser::isSafari())
            $browser = 'Chrome';
        return view( 'investor-servicing.choose.investment', [ 'title' => 'Choose Investment > Investor Servicing'] )->with(compact('data', 'userid', 'browser'));
    }

    public function captable(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {
            if ($type === 'fund') {
                $table = 'security_fund_flow';
                $s = 'digital security';
            } else if ($type === 'property') {
                $table = 'security_flow_property';
                $s = 'digital security';
            } else if ($type === 'sproperty') {
                $table = 'property';
                $s = 'investor servicing';
            }
            if (!empty($request->session()->get('capRead'))) {

                $docs = json_encode($request->session()->get('capRead'));
                $investor_details = \CapTableHelper::process_cap_table_csv( $docs );
                \CapTableHelper::process_cap_table( $id, $investor_details,  $s );

                DB::table($table)
                    ->where('userid', $userid)
                    ->where('id', $id)
                    ->update(['captables' => $docs]);

                    $request->session()->forget('capRead');
            }
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);
            $success = false;
            return view( 'investor-servicing.cap.table', [ 'title' => 'Cap Table Management > Investor Servicing'] )->with(compact('data', 'type', 'id', 'success'));
        } else {
            return redirect('/investor-servicing/choose-investment');
        }
    }
    public function exportCaptable(Request $request, $type, $id) {
        $userid = Auth::id();
        if ($type === 'fund') {
            $table = 'security_fund_flow';
        } else if ($type === 'property') {
            $table = 'security_flow_property';
        } else if ($type === 'sproperty') {
            $table = 'property';
        }
        if (!empty($request->session()->get('capRead'))) {

            $docs = json_encode($request->session()->get('capRead'));
            DB::table($table)
                ->where('userid', $userid)
                ->where('id', $id)
                ->update(['captables' => $docs]);

                $request->session()->forget('capRead');
        }
        $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);
        $success = true;
        return view( 'investor-servicing.cap.table', [ 'title' => 'Cap Table Management > Investor Servicing'])->with(compact('data', 'type', 'id', 'success'));
    }
    public function ownershipCap (Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {

            $max_distribution = Distribution::where('property_id', $id)
                                                ->groupBy('property_id')
                                                ->max('total_amount');
            $property_details = Property::find($id);

            $cash_data = $property_details->getSummary($userid);
            $investment_details = $cash_data['investment'];
            $occupancy = $cash_data['current_occupancy'];

            $distributions = $property_details->getDistributionHistory($userid);

            // NOI Graph data
            $noi_data = ['labels' => [], 'values' => []];
            $dst_reports = DstReport::join('reports', 'reports.id' , '=', 'dst_report.report_id')
            ->where( 'parent', $id )
            ->where( 'userid', $userid )
            ->select('reports.*','dst_report.total_rental_income_current')->get();
            foreach ($dst_reports as $r) {
                array_push($noi_data['labels'], $r->month." ".$r->year);
                array_push($noi_data['values'], $r->total_rental_income_current);
            }

            // Debt graph data

            $debt_data = ['labels' => [], 'values' => []];
            $op_highlights = OperationHighlight::join('reports', 'reports.id' , '=', 'operation_highlights.report_id')
                ->where( 'parent', $id )
                ->where( 'userid', $userid )
                ->select('reports.*','operation_highlights.current_principal_balance')->get();
            foreach ($op_highlights as $r) {
                array_push($debt_data['labels'], $r->month." ".$r->year);
                array_push($debt_data['values'], $r['current_principal_balance']);
            }


            return view('subdomain.investor-servicing.cap.table', ['title' => 'Cap Table Management > Investor Servicing'])
                ->with(array_merge($cash_data, compact(
                    'investment_details',
                    'property_details',
                    'distributions',
                    'type',
                    'id',
                    'max_distribution',
                    'occupancy',
                    'noi_data',
                    'debt_data')));
        } else {
            return redirect('/investor-servicing/choose-investment');
        }
    }

    public function taxCreate (Request $request) {
        $session_data = session( 'tax', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'tax' => $session_data ] );
        $type = $request->get('tid');
        $id = $request->get('did');
        $userid = Auth::id();
        $rules = [
            'document' => 'required',
            'year' => 'required',
        ];
        $this->validate($request, $rules);
        if (!empty($request->session()->get('taxRead'))) {
            $taxRead = $request->session()->get('taxRead');
            $payload = [
                'userid' => $userid,
                'parent' => $id,
                'type' =>  $type,
                'document' => $request->get('document'),
                'year' => $request->get('year'),
                'file' =>  $taxRead,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ];
            //Notification and Mail to Investors
            $investors  = DB::table('investments')
                        ->join('users', 'users.id', '=', 'investments.userid')
                        ->where('investments.property_id', $id)
                        ->where('users.type', 'investor')
                        ->distinct('investments.userid')
                        ->select('investments.*', 'users.email')
                        ->get();
            $actice_property_name = Property::find($id)->name;
            // $delay_time = (Carbon::now()->addMinutes(1));    //test_dealy 1 minute
            $delay_time = (Carbon::now()->addHours(48));
            $user=User::find($userid);
            $user->notify((new GeneralDelayNotification('newTax', $actice_property_name))->delay($delay_time));
            dispatch((new DelayMail('newTax', $user->email, $actice_property_name))->delay($delay_time));
            foreach ($investors as $investor) {
                $investor_user = User::find($investor->userid);
                $investor_user->notify((new GeneralDelayNotification('newTax', $actice_property_name))->delay($delay_time));
                dispatch((new DelayMail('newTax', $investor_user->email, $actice_property_name))->delay($delay_time));
            }
            DB::table('taxs')->insert($payload);
            $request->session()->forget('taxRead');
            return view( 'investor-servicing.tax.index', [ 'title' => 'Tax Documents > Investor Servicing', 'success' => true ] )->with(compact('type', 'id'));
            // ->with(compact('data', 'type', 'id')); return redirect();
        } else {
            $data = $request->session()->get('tax');
            return view( 'investor-servicing.tax.index', [ 'title' => 'Tax Documents > Investor Servicing', 'errors' => true] )->with(compact('data', 'type', 'id'));
        }
    }

    public function reportsCreate (Request $request) {
        $session_data = session( 'report', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'report' => $session_data ] );
        $type = $request->get('tid');
        $id = $request->get('did');
        $userid = Auth::id();

        $rules = [
            'year' => 'required',
        ];
        $this->validate($request, $rules);
        $quater = $request->get('quarter');
        $month = $request->get('month');
        if (!empty($request->session()->get('reportRead'))) {
            $reportRead = json_encode($request->session()->get('reportRead'));
            $payload = [
                'userid' => $userid,
                'parent' => $id, //parent = property_id
                'type' =>  $type,
                'quater' => $quater ? $quater : " ",
                'month' => $month ? $month : " ",
                'year' => $request->get('year'),
                'file' =>  $reportRead,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ];
            //Notification and Mail to Investors
            $investors  = DB::table('investments')
                        ->join('users', 'users.id', '=', 'investments.userid')
                        ->where('investments.property_id', $id)
                        ->where('users.type', 'investor')
                        ->distinct('investments.userid')
                        ->select('investments.*', 'users.email')
                        ->get();
            $actice_property_name = Property::find($id)->name;
            // $delay_time = (Carbon::now()->addMinutes(1));    //test_dealy 1 minute
            $delay_time = (Carbon::now()->addHours(48));
            $user=User::find($userid);
            $user->notify((new GeneralDelayNotification('newReport', $actice_property_name))->delay($delay_time));
            dispatch((new DelayMail('newReport', $user->email, $actice_property_name))->delay($delay_time));
            foreach ($investors as $investor) {
                $investor_user = User::find($investor->userid);
                $investor_user->notify((new GeneralDelayNotification('newReport', $actice_property_name))->delay($delay_time));
                dispatch((new DelayMail('newReport', $investor_user->email, $actice_property_name))->delay($delay_time));
            }
            $report = Report::create($payload);
            $last_report_id = $report->id;
            // IDO
            $report_table = json_decode(json_encode($request->session()->get('reportTableData')));
            $rows_data = $report_table->original;
            $total_inform = $rows_data->response->rows;
            for ( $i = 0; $i < count($total_inform); $i++ ) {
                if ( strpos($total_inform[$i][0], "DST Financial") !== false)
                    break;
            }
            $operation_highlight = [
                'current_principal_balance' => $total_inform[$i + 2][9],
                'annual_interest_rate' => $total_inform[$i + 3][9],
                'maturity_date' => substr( $total_inform[$i + 4][9]->date, 0, strpos( $total_inform[$i + 4][9]->date, ' ' ) ),
                'current_amoritization' => substr( $total_inform[$i + 5][9]->date, 0, strpos( $total_inform[$i + 4][9]->date, ' ' ) ),
                'tax_escrow' => $total_inform[$i + 7][9],
                'insuarance_escrow' => $total_inform[$i + 8][9],
                'replacement_reserve_escrow' => $total_inform[$i + 9][9],
                'total_lender_reserves' => $total_inform[$i + 10][9],
                'trust_reserve' => $total_inform[$i + 13][9],
                'total_dst_reserves' => $total_inform[$i + 14][9],
                'total_reserves' => $total_inform[$i + 16][9],
                'occupancy_rate' => $total_inform[$i + 18][9],
            ];
            $dst_report = [
                'base_rent_current' => $total_inform[$i + 3][2],
                'base_rent_ytd' => $total_inform[$i + 3][3],
                'annual_rent_current' => $total_inform[$i + 4][2],
                'annual_rent_ytd' => $total_inform[$i + 4][3],
                'percentage_rent_current' => $total_inform[$i + 5][2],
                'percentage_rent_ytd' => $total_inform[$i + 5][3],
                'total_rental_income_current' => $total_inform[$i + 6][2],
                'total_rental_income_ytd' => $total_inform[$i + 6][3],
                'interest_expense_current' => $total_inform[$i + 9][2],
                'interest_expense_ytd' => $total_inform[$i + 9][3],
                'real_estate_taxes_current' => $total_inform[$i + 10][2],
                'real_estate_taxes_ytd' => $total_inform[$i + 10][3],
                'insurance_current' => $total_inform[$i + 11][2],
                'insurance_ytd' => $total_inform[$i + 11][3],
                'lender_reserves_current' => $total_inform[$i + 12][2],
                'lender_reserves_ytd' => $total_inform[$i + 12][3],
                'signatory_trustee_fee_current' => $total_inform[$i + 13][2],
                'signatory_trustee_fee_ytd' => $total_inform[$i + 13][3],
                'independent_trustee_fee_current' => $total_inform[$i + 14][2] || 0.0,
                'independent_trustee_fee_ytd' => $total_inform[$i + 14][3] || 0.0,
                'total_expenses_current' => $total_inform[$i + 15][2],
                'total_expenses_ytd' => $total_inform[$i + 15][3],
                'net_income_before_depr' => $total_inform[$i + 17][2],
                'net_income_before_amort' => $total_inform[$i + 17][3]
            ];
            $property_financial = [
                'rental_income_current' => $total_inform[$i + 26][2],
                'rental_income_ytd' => $total_inform[$i + 26][3],
                'other_rental_income_current' => $total_inform[$i + 27][2],
                'other_rental_income_ytd' => $total_inform[$i + 27][3],
                'total_rental_income_current' => $total_inform[$i + 28][2],
                'total_rental_income_ytd' => $total_inform[$i + 28][3],
                'administrative_current' => $total_inform[$i + 30][2],
                'administrative_ytd' => $total_inform[$i + 30][3],
                'payroll_current' => $total_inform[$i + 31][2],
                'payroll_ytd' => $total_inform[$i + 31][3],
                'marketing_current' => $total_inform[$i + 32][2],
                'marketing_ytd' => $total_inform[$i + 32][3],
                'utilities_current' => $total_inform[$i + 33][2],
                'utilities_ytd' => $total_inform[$i + 33][3],
                'repairs_maintenance_current' => $total_inform[$i + 34][2],
                'repairs_maintenance_ytd' => $total_inform[$i + 34][3],
                'grounds_current' => $total_inform[$i + 35][2],
                'grounds_ytd' => $total_inform[$i + 35][3],
                'other_operating_current' => $total_inform[$i + 36][2],
                'other_operating_ytd' => $total_inform[$i + 36][3],
                'licenses_permits_current' => $total_inform[$i + 37][2],
                'licenses_permits_ytd' => $total_inform[$i + 37][3],
                'property_management_fees_current' => $total_inform[$i + 38][2],
                'property_management_fees_ytd' => $total_inform[$i + 38][3],
                're_taxes_current' => $total_inform[$i + 39][2],
                're_taxes_ytd' => $total_inform[$i + 39][3],
                'insurance_current' => $total_inform[$i + 40][2],
                'insurance_ytd' => $total_inform[$i + 40][3],
                'capital_activity_current' => $total_inform[$i + 41][2],
                'capital_activity_ytd' => $total_inform[$i + 41][3],
                'total_operating_costs_current' => $total_inform[$i + 42][2],
                'total_operating_costs_ytd' => $total_inform[$i + 42][3],
                'net_operating_income_current' => $total_inform[$i + 28][2] - $total_inform[$i + 42][2],
                'net_operating_income_ytd' => $total_inform[$i + 28][3] - $total_inform[$i + 42][3]
            ];
            $cash_distribution = [
                'cumulative_cash_distribution' => $total_inform[$i + 25][9],
                'cumulative_annualized' => $total_inform[$i + 28][9],
                'pre_tax_cumulative' => $total_inform[$i + 30][9],
                'current_month_cash' => $total_inform[$i + 32][9],
                'current_month_annualized' => $total_inform[$i + 35][9],
                'pre_tax_current_annualized' => $total_inform[$i + 38][9]
            ];
            $dst = New DstReport($dst_report);
            $dst->report_id = $last_report_id;
            $dst->save();
            $op_highlight = New OperationHighlight($operation_highlight);
            $op_highlight->report_id = $last_report_id;
            $op_highlight->save();

            $property_highlight = New PropertyFinancialHighlight($property_financial);
            $property_highlight->report_id = $last_report_id;
            $property_highlight->save();

            $cash = New CashDistributionSummary($cash_distribution);
            $cash->report_id = $last_report_id;
            $cash->save();
            //-----------------
            $request->session()->forget('reportRead');
            $request->session()->forget('reportTableData');
            return redirect('/investor-servicing/reports/dt/'. $type. '/'.strtolower(str_random(30)). '/' .$id);
        } else {
            $data = $request->session()->get('report');
            $request->session()->forget('reportTableData');
            return view( 'investor-servicing.tax.index', [ 'title' => 'Reports > Investor Servicing', 'errors' => true] )->with(compact('data', 'type', 'id'));
        }
    }

    public function getSession(Request $request) {
        return $request->session()->get('capRead');
    }

    public function tax(Request $request, $type, $rand, $id) {
        return view( 'investor-servicing.tax.index', [ 'title' => 'Tax Documents > Investor Servicing'] )->with(compact('type', 'id'));
    }

    public function reports(Request $request, $type, $rand, $id) {
        $report_data = Report::where('parent', $id)
                ->where('type', $type)
                ->get();
        return view( 'investor-servicing.reports.index', [ 'title' => 'Reports > Investor Servicing'] )->with(compact('type', 'id', 'report_data'));
    }

    public function dst(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);
        if ( $type == 'sproperty' )
        {
            $report_data = Report::latest('created_at')->first();
            $report_id = $report_data->id;
            $dst_data = $report_data->dstReport ?? [];
            $operation_data = $report_data->operationHighlight ?? [];
            $property_data = $report_data->propertyFinancialHighlight ?? [];
            $cash_data = $report_data->cashDistributionSummary ?? [];
        }
        return view( 'investor-servicing.dst.index', [ 'title' => 'Reports > Investor Servicing'] )->with(compact('data', 'type', 'id', 'dst_data', 'operation_data', 'property_data', 'cash_data', 'report_id'));
    }

    public function investorReport(Request $request, $type, $rand, $id){
        $report_id = $request->get('report_id');
        $userid = Auth::id();
        $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);
        $investment_data = Investment::where('property_id', $id)
            ->where('userid', $userid)
            ->first();
        $report = Report::find($report_id);
        $dst_data = $report->dstReport ?? [];
        $operation_data = $report->operationHighlight ?? [];
        $property_data = $report->propertyFinancialHighlight ?? [];
        $cash_data = $report->cashDistributionSummary ?? [];
        //$cash_data->cumulative_cash_distribution = \CashDistributionSummary::getCashFlowToDate($report_id, $id, $userid);
        //$cash_data->current_month_cash = \CashDistributionSummary::getCurrentCashFlow($report_id, $id, $userid);
        return view( 'subdomain.investor-servicing.dst.index', [ 'title' => 'Reports > Investor Servicing'] )->with(compact('data', 'type', 'id', 'dst_data', 'operation_data', 'property_data', 'cash_data', 'report_id'));
    }
    public function final (Request $request) {
        $userid = Auth::id();
        $bio = DB::table('account_verification')
            ->where('userid', $userid)
            ->value('bio');
        $data = $request->session()->get('security-flow');
        return view( 'security-fund-flow.step-7.final', [ 'title' => 'Create Digital Security > Preview & Submit' ] )->with(compact('data', 'bio'));
    }

    public function downloadCapTableCSV( Request $request, $type, $property_id ) {
        if( $type != 'sproperty' ) {
            // @TODO implement
            return;
        }

        // Ensure this is our property
        $property = Property::find($property_id);
        if( $property->userid != Auth::id() ) {
            return redirect( '/' );
        }
        $data = json_decode($property->captables)->original->response;

        // Fetch the cap table
        //$cap_table = \CapTableHelper::get_cap_table( $property_id );
        ob_clean();
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . 'Cap Table '.$property_id.' (Generated by Abstract Tokenization).csv');
        if(isset($data->headers)){
            $fp = fopen('php://output', 'w');
            fputcsv($fp, [
                "Property or Fund Name",
                "Company Name",
                "Company Tax ID #",
                "Company Debit Account",
                "Company Bank ACH Routing",
                "Sponsor Investment Amt",
                "Sponsor ownership",
                "Total Equity Amount",
            ]);
            array_pop($data->headers);
            fputcsv($fp, $data->headers);
            fputcsv($fp,[]);
            fputcsv($fp,[
                "Investor Name on Bank Account",
                "% Ownership",
                "Investment Date",
                "Investment Amount",
                "Email","ACH ABA Routing Number",
                "Bank Account Number",
                "Account Type",
                "Investor Tax ID"
            ]);
            foreach($data->rows AS $row){
                $date = dateFromRow($row[2]);
                $row[2] = $date;
                fputcsv($fp, $row);
            }
            fclose($fp);
        }

        ob_flush();
    }

    public function downloadDSTReportPdf(Request $request, $type, $report_id) {
        if ( $type != 'sproperty' ) {
            return;
        }
        $id = Auth::id();
        $report_data = Report::find($report_id);
        $report_date = $report_data->year;
        if ( $report_data->quater != " " )
            $report_date = $report_date." ".$report_data->quater;
        if ( $report_data->month != " ")
            $report_date = $report_date." ".$report_data->month;
        $property = Property::find($report_data->parent);
        $sponsor_data = DB::table('account_verification')
            ->where('userid', $property->userid)
            ->select('company_name')
            ->first();
        $sponsor_name= DB::table('users')
            ->where('id', $property->userid)
            ->select('first_name', 'last_name')
            ->first();

        $user_data = DB::table('users')
            ->where('id', $id)
            ->select('type')
            ->first();
        $dst_data = $report_data->dstReport ?? [];
        $operation_data = $report_data->operationHighlight ?? [];
        $property_data = $report_data->propertyFinancialHighlight ?? [];
        $cash_data = $report_data->cashDistributionSummary ?? [];

        if ($user_data->type == 'investor') {
            //$cash_data->cumulative_cash_distribution = \CashDistributionSummary::getCashFlowToDate($report_id, $property->id, $id);
            //$cash_data->current_month_cash = \CashDistributionSummary::getCurrentCashFlow($report_id, $property->id, $id);
        }
        $pdf = PDF::loadView('investor-servicing.reports.download', [
            'dst_data' => $dst_data,
            'operation_data' => $operation_data,
            'property_data' => $property_data,
            'cash_data' => $cash_data,
            'report_date' => $report_date,
            'company_name' => $sponsor_data != null ? $sponsor_data->company_name: $sponsor_name->first_name." ".$sponsor_name->last_name,
            'property_name' => $property->name,
            'id' => $id
        ]);
        return $pdf->download($property->name.'( '.$report_date.' ).- DST Report.pdf');
    }
}
