<?php
namespace App\Http\Controllers;

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
use App\Exports\CSVReportExport;
use App\Investment;
use App\Report;
use Illuminate\Support\Carbon;
use Excel;
use PDF;
use Browser;
use Carbon\Carbon as CarbonCarbon;
use DateTime;
use View;
use PDFWithJS;

class InvestorServicingReportsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    function reportsViewOldCSV() {
        $report = $this->report;
        $report_date_year = $report->year;
        $report_date_month =  $report->month;
        $property = Property::find($report->parent);

        return Excel::download(new CSVReportExport($report->id, $this->user_id), $property->name.'( '.$report_date_year.'.'. $report_date_month. ' ) - DST Report CSV.xlsx');
    }

    function get(Request $request, $id) {
        $this->user_id = Auth::id();

        $report_type = $request->get('report_type');
        $report_id = $request->get('report_id');
        $this->preview = $request->get('preview');
        $this->report = Report::find($report_id);
        $this->property_detail = Property::find($id);

        if($request->get('download') == 'CSV') {
            return $this->reportsViewOldCSV();
        } else {
            switch ($report_type) {
                case 'highlights':
                    return $this->loanHighlights();
                case 'cash':
                    return $this->cashDistSummary();
                case 'dst':
                    return $this->dst();
                case 'operating':
                    return $this->operatingStatement();
                default:
                    # code...
                    break;
            }
        }
    }

    function headerData() {
        $report_date = $this->report->year;
        if ( $this->report->quater != " " )
            $report_date = $report_date." ".$this->report->quater;
        if ( $this->report->month != " ")
            $report_date = $report_date." ".$this->report->month;
        $this->report_date = $report_date;
        $property = $this->property_detail;
        $sponsor_data = DB::table('account_verification')
            ->where('userid', $property->userid)
            ->select('company_name')
            ->first();
        $sponsor= $property->user;
        $company_name = $sponsor_data != null ? $sponsor_data->company_name: $sponsor->first_name." ".$sponsor->last_name;
        $property_name = $property->name;
        $id = $this->user_id;
        return compact('report_date', 'company_name', 'property_name', 'id');
    }

    function loanHighlights() {

        $data = array_merge([
            'operation_data' => $this->report->operationHighlight ?? []],
            $this->headerData());

        if($this->preview) {
            return view( 'investor-servicing.reports.loan-highlights', $data);
        } else {
            $file_name = 'Loan and Reserve Highlights';
            $pdf = PDF::loadView('investor-servicing.reports.loan-highlights', $data);
            return $pdf->download($this->property_detail->name.'( '.$this->report_date.' ) - ' . $file_name . ' Report.pdf');
        }
    }

    function cashDistSummary() {
        $user_id = $this->user_id;

        $property = $this->property_detail;
        $id = $property->id;
        $user_data = $this->headerData();
        $cash_data = $property->getSummary($user_id);
        $distributions = $property->getDistributionHistory($user_id);;
        $distribution_array = [['Month', 'Amount']];
        $cumulative_array = [['Year', 'Sales']];
        foreach($distributions as $d) {
            array_push($distribution_array, [$d->date->format('M Y'), $d->amount]);
            array_push($cumulative_array, [$d->date->format('M Y'), DistributionHistory::sumHistoricDistribution($id, $user_id, $d->date)]);
        }
        $cash_data['distribution_array'] = $distribution_array;
        $cash_data['cumulative_array'] = $cumulative_array;
        $data = array_merge($cash_data, $user_data);
        if($this->preview) {
            return view( 'investor-servicing.reports.cash-dist-summary', $data);
        } else {
            $pdf = PDFWithJS::loadView('investor-servicing.reports.cash-dist-summary', $data);
            $pdf->setOption('enable-javascript', true);
            $pdf->setOption('javascript-delay', 5000);
            $pdf->setOption('enable-smart-shrinking', true);
            $pdf->setOption('no-stop-slow-scripts', true);
            return $pdf->download($this->property_detail->name.'( '.$this->report_date.' ) - ' . 'Cash Distribution Chart.pdf');
        }
    }

    function dst() {
        $data = array_merge([
            'dst_data' => $this->report->dstReport ?? []],
            $this->headerData()
        );
        if($this->preview) {
            return view( 'investor-servicing.reports.dst', $data);
        } else {
            $file_name = 'DST Financial Report';
            $pdf = PDF::loadView('investor-servicing.reports.dst', $data);
            return $pdf->download($this->property_detail->name.'( '.$this->report_date.' ) - ' . $file_name . ' Report.pdf');
        }
    }

    function operatingStatement() {
        $data = array_merge([
            'operation_data' => $this->report->operationHighlight ?? [],
            'property_data' => $this->report->propertyFinancialHighlight ?? []],
            $this->headerData()
        );
        if($this->preview) {
            return view( 'investor-servicing.reports.operating-statement', $data);
        } else {
            $file_name = 'Property Operating Statement';
            $pdf = PDF::loadView('investor-servicing.reports.operating-statement', $data);
            return $pdf->download($this->property_detail->name.'( '.$this->report_date.' ) - ' . $file_name . ' Report.pdf');
        }
    }
}
