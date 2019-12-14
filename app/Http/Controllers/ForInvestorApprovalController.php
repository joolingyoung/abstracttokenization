<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\PropertyNotification;
use App\User;
use Illuminate\Http\Request;

class ForInvestorApprovalController extends Controller
{
    public function propertyApprove(Request $request)
    {
        $id = $request->input('id');
        $property = Property::find($id);
        if ($property->approval_token == $request->input('token')) {
            if ($property->status != 'Approved') {
                // If a cap table file was uploaded, populate the appropriate information
                $cap_table = json_decode($property->captables);
                $headers = $cap_table->original->response->headers;
                $investor_details = [];
                $investor_details[] = [
                    'entity_name' => $headers[1],
                    'tax_id' => $headers[2],
                    'account' => $headers[3],
                    'routing' => $headers[4],
                    'capital' => $headers[5],
                    'stake' => $headers[6],
                    'date' => date('Y-m-d', time()),
                    'email' => Auth::user()->email,
                    'sponsor' => true,
                    'type' => 'Checking',
                ];
                foreach ($cap_table->original->response->rows as $row) {
                    if ($row[2] != '') {
                        $date = dateFromRow($row[2]);
                        $investor_details[] = [
                            'entity_name' => $row[0],
                            'stake' => $row[1],
                            'date' => $date,
                            'capital' => $row[3],
                            'email' => $row[4],
                            'routing' => $row[5],
                            'account' => $row[6],
                            'type' => $row[7],
                            'sponsor' => false,
                            'tax_id' => '',
                        ];
                    }
                }
                $property->status = 'Approved';
                $property->save();
                \CapTableHelper::process_cap_table($id, $investor_details);
                return redirect('/investor-servicing/choose-investment');
            }
        }

    }

    public function propertyReject(Request $request)
    {
        // @todo
    }
}
