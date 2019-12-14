<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Property;

class Marketplace extends Controller
{
    public function mcg(Request $request) {
        $userid = Auth::id();
        // Now, fetch each property that matches
        // @TODO support more than just the property table
        // $property = DB::table('properties')
        //     ->where('userid', $userid)
        //     ->select('name', 'id')
        //     ->addSelect(DB::raw("'sproperty' as fakeType"));

        $cproperty = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', 'Approved')
            ->select(
                'property as name',
                'id',
                'target-investor-irr as targetInvestorIrr',
                'investment-profile as investmentProfile',
                'target-equity-multiple as targetEquityMultiple',
                'target-investment-period as targetInvestmentPeriod',
                'minimum-investment as minimumInvestment',
                'property_class as propertyType'
                )
            ->addSelect(DB::raw("'property' as fakeType"));

        // $property = $property->addSelect(DB::raw("'property' as fakeType"));
        $data = DB::table('security_fund_flow')
            ->where('userid', $userid)
            ->where('status', 'Approved')
            ->select(
                'fund-name as name',
                'id',
                'target-investor-irr as targetInvestorIrr',
                'investment-profile as investmentProfile',
                'target-equity-multiple as targetEquityMultiple',
                'target-investment-period as targetInvestmentPeriod',
                'minimum-investment as minimumInvestment',
                'property-class as propertyType'
                )
            ->addSelect(DB::raw("'fund' as fakeType"))
            //->union($property)
            ->union($cproperty)
            ->get();
        return view( 'marketplace.learnmore', [ 'title' => 'Approved > Properties'] )->with(compact('data', 'userid'));
    }

    public function new(Request $request, $type, $rand, $id) {
        $userid = Auth::id();
        if (isset($type) && isset($id)) {
            if ($type === 'fund') {
                $table = 'security_fund_flow';
            } else if ($type === 'property') {
                $table = 'security_flow_property';
            } else if ($type === 'sproperty') {
                $table = 'property';
            }

            $a = DB::table($table)
                ->where('userid', $userid)
                ->where('status', 'Approved')
                ->where('id', $id)
                ->first();

            $bio = DB::table('account_verification')
                ->where('userid', $userid)
                ->value('bio');

            $data = (array) $a;
            $company = DB::table('account_verification')
            ->where('userid', $userid)
            ->select('company_name')
            ->first();

            // $data ['principles'] = json_decode($data['principles']);
            return view( 'marketplace.final', [ 'title' => 'New > Marketplace'] )->with(compact('data', 'company', 'bio', 'type'));
            // return redirect('/'.$ses.'/preview');
        }
    }

    public function learnmoreDummy () {
        return view( 'marketplace.learnmoreDummy', [ 'title' => 'Details > Marketplace'] );
    }
}
