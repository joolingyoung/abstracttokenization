<?php

namespace App\Exports;

use App\Property;
use App\Report;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CSVReportExport implements FromView
{
    public $report_id;

    public function __construct($report_id, $user_id)
    {
        $this->report_id = $report_id;
        $this->user_id = $user_id;
    }

    public function view(): View
    {
        $report_id = $this->report_id;
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
        $sponsor_name= User::find($property->userid);

        $dst_data = $report_data->dstReport ?? [];
        $operation_data = $report_data->operationHighlight ?? [];
        $property_data = $report_data->propertyFinancialHighlight ?? [];
        $cash_data = $property->getSummary($this->user_id);

        return view('investor-servicing.reports.download-csv',[
            'dst_data' => $dst_data,
            'operation_data' => $operation_data,
            'property_data' => $property_data,
            'cash_data' => $cash_data,
            'report_date' => $report_date,
            'company_name' => $sponsor_data != null ? $sponsor_data->company_name: $sponsor_name->first_name." ".$sponsor_name->last_name,
            'property_name' => $property->name,
            'id' => $this->user_id
        ]);
    }
}
