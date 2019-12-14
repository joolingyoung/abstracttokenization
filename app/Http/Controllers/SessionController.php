<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rules\Email;

class SessionController extends Controller {

    use \Illuminate\Foundation\Auth\AuthenticatesUsers;
    protected $redirectTo;
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

    public function getLogin(Request $request) {
        return view('session.login');
    }

    public function getForget(Request $request) {
        return view('session.forget');
    }

    public function doForget(Request $request) {
        $this->validate($request, [
            'email' => 'required'
        ]);
        $email = $request->get('email');
        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            return view('session.forget', [ 'title' => 'Forgot Password', 'error' => true ] );
        } else {
            $forgot_token = self::generate_forgot_code( 8 );
            DB::table( 'users' )
            ->where( 'id', $user->id )
            ->update([
                'forgot_token' => $forgot_token,
            ]);

            $reset_link = 'https://' . $request->site->host . '/reset-password/' . $forgot_token;

            $reset_email = <<<EOD
To reset your password, click this link:
$reset_link

If you're receiving this message in error, you may disregard it.

-The Abstract Tokenization Team
EOD;

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom( 'no-reply@abstracttokenization.com', 'Abstract Tokenization' );
            $email->setSubject( 'Reset Your Password' );
            $email->addTo( $user->email );
            $email->addContent( 'text/plain', $reset_email );
            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            $sendgrid->send( $email );

            return redirect( '/' );
        }
    }

    public function getResetPassword(Request $request, $reset_code) {
        $user = User::where('forgot_token', '=', $reset_code)->first();
        if( !$user ) {
            return redirect( '/' );
        }

        return view('session.reset', [ 'invite_code' => $reset_code ]);
    }

    public function doResetPassword(Request $request, $reset_code) {
        $user = User::where('forgot_token', '=', $reset_code)->first();
        if( !$user ) {
            return redirect( '/' );
        }

        $password = $request->get('password');
        if( !$password ) {
            return redirect( '/reset-password/' . $reset_code );
        }

        $password = Hash::make($request->input('password'));
        DB::table( 'users' )
            ->where( 'id', $user->id )
            ->update([
                'forgot_token'  => null,
                'password'      => $password,
            ]);
        
        $this->redirectTo = '/investor-servicing/choose-investment';
        $credentials = ['email' => $user->email, 'password' => $request->input('password') ];
    
        if (Auth::attempt($credentials, true)) {
            if( $request->site->id == 1 ) {
                return redirect()->intended('/sponsor/introduction');
            } else {
                return redirect()->intended('/investor-servicing/choose-investment');
            }
        } else {
            return redirect( '/' );
        }

    }

    public function doLogin(Request $request) {
        $credentials = $request->only('email', 'password');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $this->validate($request, [
            'email' => ['required', new Email]
        ]);
        if (Auth::attempt($credentials, true)) {
            if( $request->site->id == 1 ) {
                return redirect()->intended('/portfolio');
            } else {
                return redirect()->intended('/dashboard');
            }
        } else {
            return view('session.login', [ 'error' => true ] );
        }
    }

    public function getRegister(Request $request) {
        return view('session.register');
    }

    public function doRegister(Request $request) {
        $type = $request->input('type');
        $company_name = $request->input('company_name');
        $first_name = $request->input('first');
        $last_name = $request->input('last');
        $email = $request->input('email');
        $password = $request->input('password');
        $site_id = $request->site->id;
        $this->validate($request, [
            'email' => ['required', new Email]
        ]);
        
        if (!$type) {
            $this->validate($request, [
                'company_name' => 'required'
            ]);
        }

        if (sizeof(User::where('email','=',$email)->get()) > 0) {
            return view('session.register', [ 'error' => true, 'msg' => 'Email address is already registered. Please log in?'] );
        }

        $user_id = User::create([
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'email'         => $email,
            'password'      => Hash::make($password),
            'site_id'       => $site_id,
            'type'          => $type ? 'investor' : 'sponsor',
            'profile_image' => '/img/default-profile.png',
            'company_name'  => $company_name
        ])->id;

        // If the user is registering on the primary site, make them a "sponsor" for the subsite
        if( $request->site->id == 1 ) {
            DB::table( 'microsite_sponsors' )->insert(
                [ 'sponsorid' => $user_id, 'siteid' => 2 ]
            );
        }

        if( !$type ) {
            $this->redirectTo = '/diligence/verification';
        } else {
            $this->redirectTo = '/investor-servicing/choose-investment';
        }

        return $this->login($request);
    }

    public function doLogout(Request $request) {
        Auth::logout();
        return redirect( '/' );
    }

    public function getInvite(Request $request, $invite_code) {
        // Determine if this is a valid invite code
        $maybe_user = DB::table( 'users' )->where( 'invite_code', $invite_code )->first();
        if( !$maybe_user ) {
            return redirect( '/' );
        }

        return view( 'session.invite', [ 'user' => $maybe_user, 'invite_code' => $invite_code ] );
    }

    public function doInvite(Request $request, $invite_code) {
        $first_name = $request->input('first');
        $last_name = $request->input('last');
        $password = Hash::make($request->input('password'));
        $user = DB::table( 'users' )->where( 'invite_code', $invite_code )->first();

        if( !$user ) {
            return redirect( '/' );
        }

        DB::table( 'users' )
            ->where( 'id', $user->id )
            ->update([
                'invite_code'   => '',
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'password'      => $password
            ]);
        
        $this->redirectTo = '/investor-servicing/choose-investment';
        $credentials = ['email' => $user->email, 'password' => $request->input('password') ];
 
        if (Auth::attempt($credentials, true)) {
            if( $request->site->id == 1 ) {
                return redirect()->intended('/sponsor/introduction');
            } else {
                return redirect()->intended('/investor-servicing/choose-investment');
            }
        } else {
            return redirect( '/' );
        }
    }

    private static function generate_forgot_code( $length = 10 ) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}