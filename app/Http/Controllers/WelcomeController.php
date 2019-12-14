<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller {
    public function userType(Request $request) {
        return view('onboarding.step1', [ 'sections' => false ]);
    }

    public function setUserType(Request $request) {
        $type = $request->input( 'type', 'both' );
        $user = Auth::user();
        
        DB::table('users')
            ->where('id', $user['id'])
            ->update(['type' => $type]);
        
        return redirect('/welcome/overview');
    }

    public function allSet(Request $request) {
        return view('onboarding.step2', [ 'sections' => false ]);
    }

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }
}