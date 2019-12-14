<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SponsorController extends Controller {
    public function welcome() {
        return view('sponsors.welcome');
    }
    public function intro() {
        return view('sponsors.intro');
    }
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth.details');
    }
    public function scheduleDemo() {
        $sponsor_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $from_address = 'no-reply@abstracttokenization.com';
        $from_name = 'Abstract Tokenization';
        $to_address = 'abel@abstracttokenization.com';
        $subject = 'Schedule a Demo for ' . $sponsor_name;
        $data = [ 'sponsor_name' => $sponsor_name ];
        $view = 'emails.sponsor-schedule-demo';
        sendMail($from_address, $from_name, $to_address, $subject, $data, $view);
        
        return redirect('/sponsor/introduction');
    }
}