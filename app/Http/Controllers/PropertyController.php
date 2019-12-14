<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\InvestorPropertyNotification;
use App\User;
use App\Investment;
use App\Property;

class PropertyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }

    public function newProperty(Request $request) {
        $userid = Auth::id();
        $company = DB::table('account_verification')
            ->where('userid', $userid)
            ->select('company_name')
            ->first();

        $data = $request->session()->get('property');
        $type = 'sproperty';

        return view('investor-servicing.property.index', ['title' => 'Upload New Property > Investor Servicing'])->with(compact('data', 'company', 'type'));
    }

    // Submit Preview Data
    public function submitPreview(Request $request)
    {
        $session_data = session('property', array());
        $session_data = array_merge($session_data, $_POST);
        session(['property' => $session_data]);

        $rules = [
            'property_image' => 'required',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
            'bankTransfer' => 'required',
        ];

        $this->validate($request, $rules);
        if (!empty($request->session()->get('capRead'))) {
            $capRead = json_encode($request->session()->get('capRead'));
        } else {
            $capRead = '';
        }
        $userid = Auth::id();

        $property = New Property();
        $property->property_type = 'sproperty';
        $property->fill($request->only($property->getFillable()));
        $property->userid = $userid;
        $property->captables = $capRead;
        $property->status = 'Approved';

        $investor_details = \CapTableHelper::process_cap_table_csv( $capRead );
        $property->save();
        $property_id = $property->id;
        \CapTableHelper::process_cap_table( $property_id, $investor_details, 'investor servicing');

        if ($request->session()->get('investor-servicing-files')) {
            $files = $request->session()->get('investor-servicing-files');
            foreach ($files as $key => $value) {
                DB::table('files')
                    ->where('section', 'investor-servicing-files')
                    ->where('map', $value['map'])
                    ->update(['section_id' => $property_id]);
            }
        }
        $request->session()->forget('investor-servicing-files');

        $request->session()->forget('property');
        $request->session()->forget('capRead');

        return view( 'investor-servicing.property.index', [ 'title' => 'Upload New Property > Investor Servicing', 'success' => true ] );
    }

    public function pending(Request $request)
    {
        $userid = Auth::id();

        // Now, fetch each property that matches
        // @TODO support more than just the property table
        $property = DB::table('properties')
            ->where('userid', $userid)
            ->select('name', 'id');
        //Pending Data
        $cproperty = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', 'Pending')
            ->select('property as name', 'id')
            ->addSelect(DB::raw("'property' as fakeType"));

        // $property = $property->addSelect(DB::raw("'property' as fakeType"));
        $data = DB::table('security_fund_flow')
            ->where('userid', $userid)
            ->where('status', 'Pending')
            ->select('fund-name as name', 'id')
            ->addSelect(DB::raw("'fund' as fakeType"))
        // ->union($property)
            ->union($cproperty)
            ->get();

        //Rejected Data
        $cproperty_rejected = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', 'Rejected')
            ->select('property as name', 'id')
            ->addSelect(DB::raw("'property' as fakeType"));

        $data_rejected = DB::table('security_fund_flow')
            ->where('userid', $userid)
            ->where('status', 'Rejected')
            ->select('fund-name as name', 'id')
            ->addSelect(DB::raw("'fund' as fakeType"))
            ->union($cproperty_rejected)
            ->get();

        return view('my-properties.pending',
            ['title' => 'Pending > Properties'])->with(compact('data', 'data_rejected', 'userid'));
    }

    public function approved(Request $request)
    {
        $userid = Auth::id();

        // Now, fetch each property that matches
        // @TODO support more than just the property table

        $property = DB::table('security_flow_property')
            ->where('userid', $userid)
            ->where('status', 'Approved')
            ->select('property as name', 'id')
            ->addSelect(DB::raw("'property' as fakeType"));

        // $property = $property->addSelect(DB::raw("'property' as fakeType"));
        $data = DB::table('security_fund_flow')
            ->where('userid', $userid)
            ->where('status', 'Approved')
            ->select('fund-name as name', 'id')
            ->addSelect(DB::raw("'fund' as fakeType"))
            ->union($property)
            ->get();
        return view('my-properties.approved', ['title' => 'Approved > Properties'])->with(compact('data', 'userid'));
    }

    public function sticker(Request $request, $type, $rand, $id)
    {
        $userid = Auth::id();

        if (isset($type) && isset($id)) {
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);

            return view('my-properties.sticker', ['title' => 'Choose Sticker > Properties'])->with(compact('data', 'type', 'id'));
        }
    }

    public function metrics(Request $request, $type, $rand, $id)
    {
        $userid = Auth::id();

        if (isset($type) && isset($id)) {
            $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);

            return view( 'my-properties.recap', [ 'title' => 'Investment Metrics > Properties'] )->with(compact('data', 'type', 'id'));
        }
    }

    public function edit(Request $request, $type, $id) {
            $userid = Auth::id();
            if (isset($type) && isset($id)) {
                if ($type === 'fund') {
                    $table = 'security_fund_flow';
                    $ses = 'security-fund-flow';
                } else if ($type === 'property') {
                    $table = 'security_flow_property';
                    $ses = 'security-flow';
                } else if ($type === 'sproperty') {
                    $table = 'property';
                    $ses = 'property';
                }

                $data = DB::table($table)
                    ->where('userid', $userid)
                    ->where('status', 'Approved')
                    ->first();

                $array = (array) $data;
                // $array ['principles'] = json_decode($array['principles']);

                $request->session()->put($ses, $array);
                return redirect('/'.$ses.'/preview');
            } else {
                return redirect('/properties/approved');
            }
    }

    public function recap(Request $request, $type, $rand, $id)
    {
        return view('my-properties.popup', ['title' => 'Investment Metrics > Properties'])->with(compact('type', 'id'));
    }
}
