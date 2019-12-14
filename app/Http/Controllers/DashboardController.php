<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Distribution;
use App\Investment;
use App\OperationHighlight;
use App\DistributionHistory;
use App\Report;
use App\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rules\Email;
use DateTime;


class DashboardController extends Controller {

    protected $cumulative_annualized_return;
    protected $total_investment_amount;
    protected $annualized_return_YTD;
    protected $distributions_YTD;
    protected $aggregate_cash_flow;
    protected $chart = [
        'original' => [
            'response' => [
                'rows' => [
                ]
            ]
        ]
    ];

    public function getProcessOfferings($serach_text = '') {
        $userid = Auth::id();

        $processOfferings = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', '!=', 'Approved')
            ->where('property_address', 'LIKE', '%'.$serach_text.'%')
            ->select(
                'id',
                'status',
                'property_address as address',
                'target-investor-irr as investor_irr',
                'target-equity-multiple as equity_multiple',
                'target-investment-period as investment_period',
                'investment-profile as investment_profile',
                'minimum-investment as investment_minimum',
                'offers-due as investment_offer',
                'distribution-period as distribution_period',
                'property-type as property_type',
                'distribution-commencement as distribution_start'
            )
            ->get();

        return $processOfferings;
    }

    public function getCurrentOfferings($serach_text = '') {
        $userid = Auth::id();

        $cproperty = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', 'Approved')
            ->where('property_address', 'LIKE', '%'.$serach_text.'%')
            ->select(
                'id',
                'property_address as address',
                'target-investor-irr as investor_irr',
                'target-equity-multiple as equity_multiple',
                'target-investment-period as investment_period',
                'investment-profile as investment_profile',
                'minimum-investment as investment_minimum',
                'offers-due as investment_offer',
                'distribution-period as distribution_period',
                'property-type as property_type',
                'distribution-commencement as distribution_start'
            )
            ->addSelect(DB::raw("'property' as fakeType"));

        $currentOfferings = DB::table('security_fund_flow')
            ->where('userid', $userid)
            ->where('fund-address', 'LIKE', '%'.$serach_text.'%')
            ->select(
                'id',
                'fund-address as address',
                'target-investor-irr as investor_irr',
                'target-equity-multiple as equity_multiple',
                'target-investment-period as investment_period',
                'investment-profile as investment_profile',
                'minimum-investment as investment_minimum',
                'offers-due as investment_offer',
                'distribution-period as distribution_period',
                'property-type as property_type',
                'distribution-commencement as distribution_start'
            )
            ->addSelect(DB::raw("'fund' as fakeType"))
            ->union($cproperty)
            ->get();

        return $currentOfferings;
    }

    public function viewDashboard($property_details, $serach_text = '', $order_item = '') {
        $chart = json_encode($this->chart);
        $cumulative_annualized_return = round($this->cumulative_annualized_return, 2);
        $total_investment_amount = round($this->total_investment_amount, 2);
        $annualized_return_YTD = round($this->annualized_return_YTD, 2);
        $distributions_YTD = round($this->distributions_YTD, 2);
        $aggregate_cash_flow = round($this->aggregate_cash_flow, 2);

        $process_offerings = $this->getProcessOfferings($serach_text);
        $current_offerings = $this->getCurrentOfferings($serach_text);

        return view('dashboard')->with(compact(
            'property_details',
            'chart',
            'total_investment_amount',
            'aggregate_cash_flow',
            'cumulative_annualized_return',
            'annualized_return_YTD',
            'distributions_YTD',
            'serach_text',
            'order_item',
            'process_offerings',
            'current_offerings'
        ));
    }

    public function dashboard(Request $request) {
        $search_text = $request->post('search-text');
        $order_item = $request->post('order-item');
        $user_id = Auth::id();
        $current_holdings = [];
        $past_holdings = [];
        $current_date = new DateTime();
        $current_investment_amount = 0;
        $cumulative_annualized_return = 0;
        $annualized_return_YTD = 0;
        $aggregate_cash_flow = 0;
        $distributions_YTD = 0;

        $properties = Property::all();
        $rows = [];
        $total_investment_amount = Investment::where('userid', $user_id)
            ->sum('amount');

        foreach($properties as $property) {

            $summary = $property->getSummary($user_id);
            if(empty($summary)) continue;

            // Sum of all distributions received by investor since investment start date from current and past holdings.
            $aggregate_cash_flow += $summary['cumulative_cash_distribution'];

            // Weighted average (based on capital contributed) of investor’s cumulative annualized return of current and past holdings. Capital Contributed to Property N / Total Capital Contributed to All Properties
            $cumulative_annualized_return += $summary['cumulative_annualized'] * $summary['capital_contributed'] / $total_investment_amount;

            // Distributions YTD = Sum of distributions received in the current year from current & past holdings
            $distributions_YTD += $summary['distribution_ytd'];

            // Months held in current year
            $month_in_current_year = (strtotime($summary['last_distribution_date']) - max(strtotime(date('Y-01-01')), $summary['investment_date']->timestamp)) / (30*60*60*24);
            // Annualized Return YTD = (Sum of distributions received from past & current holdings in the current year / total months held in current year / capital contributed) * 12
            $annualized_return_YTD += $summary['distribution_ytd'] / $month_in_current_year / $summary['capital_contributed'] * 12;

            // Pie chart data with percentage of investment
            $rows[] = [$summary['name'], $summary['capital_contributed'] / $total_investment_amount];

            // Property list
            if(!empty($search_text) && strpos($property->name, $search_text) == false) continue;
            if($property->holding_status == 'active') {
                $current_holdings[] = $summary;
                $current_investment_amount += $summary['capital_contributed'];
            } else if ($property->holding_status == 'past') {
                $past_holdings[] = $summary;
            }
        }

        if(!empty($order_item)) {
            $current_holdings = collect($current_holdings)->sortByDesc($order_item)->values();
            $past_holdings = collect($past_holdings)->sortByDesc($order_item)->values();
        }

        $rows = collect($rows)->sortByDesc(function ($row, $key){
            return $row[1];
        })->values();
        $rows = collect($rows)->take(10)->all();

        $this->chart['original']['response']['rows'] = $rows;
        $chart = json_encode($this->chart);
        $process_offerings = $this->getProcessOfferings($search_text);
        $current_offerings = $this->getCurrentOfferings($search_text);
        return view('dashboard')->with(compact(
            'current_holdings',
            'past_holdings',
            'chart',
            'total_investment_amount',
            'current_investment_amount',
            'aggregate_cash_flow',
            'cumulative_annualized_return',
            'annualized_return_YTD',
            'distributions_YTD',
            'search_text',
            'order_item',
            'process_offerings',
            'current_offerings'
        ));
    }

    public function portfolio(Request $request) {
        $user_id = Auth::id();
        $search_text = $request->post('search-text');
        $order_item = $request->post('order-item');
        $current_holdings = [];
        $past_holdings = [];
        $current_date = new DateTime();
        $total_investment_amount = 0;
        $current_investment_amount = 0;
        $cumulative_annualized_return = 0;
        $annualized_return_YTD = 0;
        $aggregate_cash_flow = 0;
        $distributions_YTD = 0;
        $rows = [];
        $total_investment_amount = Investment::where('investments.userid', $user_id)
            ->join('properties', 'properties.id', 'property_id')
            ->where('properties.userid', $user_id)
            ->sum('amount');

        $properties = Property::where('userid', $user_id)->get();

        foreach($properties as $property) {

            $summary = $property->getSummary($user_id);
            if(empty($summary)) continue;

            // Sum of all distributions received by investor since investment start date from current and past holdings.
            $aggregate_cash_flow += $summary['cumulative_cash_distribution'];

            // Weighted average (based on capital contributed) of investor’s cumulative annualized return of current and past holdings. Capital Contributed to Property N / Total Capital Contributed to All Properties
            $cumulative_annualized_return += $summary['cumulative_annualized'] * $summary['capital_contributed'] / $total_investment_amount;

            // Distributions YTD = Sum of distributions received in the current year from current & past holdings
            $distributions_YTD += $summary['distribution_ytd'];

            // Months held in current year
            $month_in_current_year = (strtotime($summary['last_distribution_date']) - max(strtotime(date('Y-01-01')), $summary['investment_date']->timestamp)) / (30*60*60*24);
            // Annualized Return YTD = (Sum of distributions received from past & current holdings in the current year / total months held in current year / capital contributed) * 12
            $annualized_return_YTD += $summary['distribution_ytd'] / $month_in_current_year / $summary['capital_contributed'] * 12;

            // Pie chart data with percentage of investment
            $rows[] = [$summary['name'], $summary['capital_contributed'] / $total_investment_amount];

            // Property list
            if(!empty($search_text) && strpos($property->name, $search_text) == false) continue;

            if($property->holding_status == 'active') {
                $current_holdings[] = $summary;
                $current_investment_amount += $summary['capital_contributed'];
            } else if ($property->holding_status == 'past') {
                $past_holdings[] = $summary;
            }

        }

        if(!empty($order_item)) {
            $current_holdings = collect($current_holdings)->sortByDesc($order_item)->values();
            $past_holdings = collect($past_holdings)->sortByDesc($order_item)->values();
        }

        $rows = collect($rows)->sortByDesc(function ($row, $key){
            return $row[1];
        })->values();
        $rows = collect($rows)->take(10)->all();

        $this->chart['original']['response']['rows'] = $rows;
        $chart = json_encode($this->chart);
        $process_offerings = $this->getProcessOfferings($search_text);
        $current_offerings = $this->getCurrentOfferings($search_text);
        return view('dashboard.portfolio')->with(compact(
            'current_holdings',
            'past_holdings',
            'chart',
            'total_investment_amount',
            'current_investment_amount',
            'aggregate_cash_flow',
            'cumulative_annualized_return',
            'annualized_return_YTD',
            'distributions_YTD',
            'search_text',
            'order_item',
            'process_offerings',
            'current_offerings'
        ));
    }
}
