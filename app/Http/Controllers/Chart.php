<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Chart extends Controller
{
    public function saveCap(Request $request) {
        $session_data = session( 'capInfoTemp', array() );
        $session_data = array_merge( $session_data, $_POST );
        session( [ 'capInfoTemp' => $session_data ] );

        return response()->json([
            'response' => 'Saved'
        ]);
    }
}
