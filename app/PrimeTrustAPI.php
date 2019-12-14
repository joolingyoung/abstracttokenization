<?php
use GuzzleHttp\Client;

class PrimeTrustAPI {
    public $base_URL = 'https://sandbox.primetrust.com/';

#-----------------------HELPER---------------------------

//  Send the HTTP request to Prime Custody API server    
    private function doRequest($url, $method, $body = [], $token = NULL, $prefix = NULL) {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        if( !is_null($token)) {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => $prefix.' '.$token,
            ];
        }

        $client = new Client([
            'headers' => $headers
        ]);

        $res = $client->request($method, $url, $body);

        return $res->getBody()->getContents();
    }


//  Extract Data
    private function extractData($data, $prime) {
        $info = json_decode($data);

        return $prime ? $info->data->id : $info->token;
    }

#---------------------ACCOUNT_TABLE--------------------

//  Get Current Custody Account
    public function getCustodyAccount($user_email) {
        $accounts = DB::table('custody_accounts')
            ->where('user_email', $user_email)
            ->select(['user_id', 'account_id', 'token_symbol', 'token_count', 'token_balance', 'total_budget', 'updated_at'])
            ->get();

        return compact('accounts')['accounts'];
    }

//  Create Custody Record with and insert into custody_accounts table
    public function createCustodyRecord($user_email, $user_id, $token_symbol, $token_count, $account_id = NULL) {
        $record = array(
            'user_email' => $user_email,
            'user_id' => $user_id,
            'account_id' => $account_id,
            'token_symbol' => $token_symbol,
            'token_count' => $token_count,
        );
        DB::table('custody_accounts')->insert($record);
    }

    public function updateCustodyRecord($account_id, $funds, $jwt_token) {
        $info = $this->getCashTotals($account_id, $jwt_token);
        $total_budget = $info->{'contingent-hold'};
        $updated_at = new DateTime($info->{'updated-at'});

        DB::table('custody_accounts')
            ->where('account_id', $account_id)
            ->update( [ 'total_budget' => $total_budget, 'token_balance' => $funds, 'updated_at' => $updated_at ] );
    }

#----------------------PRIME_TRUST_USER----------------------

//  Authroize the pending funds 
    public function authorizeFunds($contribution_id, $funds, $jwt_token) {
        $body = [
            'data' => [
                'type' => 'contributions',
                'attributes' => [
                    'amount' => $funds,
                    'payment-source-name' => 'Hot Rod sandbox',
                    'payment-details' => 'Wire CUSQAXA'
                ]
            ]
        ];

        return $this->doRequest($this->base_URL.'v2/contributions/'.$contribution_id.'/sandbox/authorize',
            'post', [ 'body' => json_encode($body) ], $jwt_token, 'Bearer');
    }

//  Create the funds transfer to custody account
    public function createContribution($user_email, $account_id, $funds, $jwt_token) {
        $body = [
            'data' => [
                'type' => 'contributions',
                'attributes' => [
                    'account-id' => $account_id,
                    'funds_transfer_method' => [
                        'funds-transfer-type' => 'ach',
                        'ach-check-type' => 'personal',
                        'bank-account-name' => 'John James Doe',
                        'bank-account-type' => 'checking',
                        'bank-account-number' => '1234567890',
                        'routing-number' => '123456789',
                        'contact-email' => $user_email,
                        'contact-name' => 'John Doe'
                    ],
                    'amount' => (string)$funds
                ]
            ]
        ];

        $res = $this->doRequest($this->base_URL.'v2/contributions', 'post', [ 'body' => json_encode($body) ], $jwt_token, 'Bearer');

        return $this->extractData($res, true);
    }

//  Crate Custody User with logged in user's info
    public function createCustodyUser($user_email, $user_name, $password) {
        $body = [
            'data' => [
                'type' => 'user', 
                'attributes' => [
                    'email' => $user_email, 
                    'name' => $user_name, 
                    'password' => $password,
                ]
            ],
        ];

        $res = $this->doRequest($this->base_URL.'v2/users', 'post', [ 'body' => json_encode($body) ]);

        return $this->extractData($res, true);
    }

//  Create Custody Account with given token_symbol and count.
    public function createCustodyAccount($user_email, $user_name, $token_symbol, $token_count, $jwt_token) {
        $body = [ 
            'data' => [ 
                'type' => 'account', 
                'attributes' => [
                    'account-type' => 'custodial',
                    'name' => $user_name,
                    'authorized-signature' => $user_name,
                    'token_symbol' => $token_symbol,
                    'token_count' => $token_count,
                    'owner' => [
                        'contact-type' => 'natural_person',
                        'name' => 'John Doe',
                        'email' => $user_email,
                        'date-of-birth' => '1980-06-09',
                        'sex' => 'male',
                        'tax-id-number' => '123123123',
                        'tax-country' => 'US',
                        'primary-phone-number' => [
                            'country' => 'US',
                            'number' => '7026912020',
                            'sms' => true,
                        ],
                        'primary-address' => [
                            'street-1' => '330 S. Rampart',
                            'street-2' => 'Apt 260',
                            'postal-code' => '89145',
                            'city' => 'Las Vegas',
                            'region' => 'NV',
                            'country' => 'US',
                        ]
                    ]
                ]
            ]
        ];

        $res = $this->doRequest($this->base_URL.'v2/accounts', 'post', [ 'body' => json_encode($body) ], $jwt_token, 'Bearer');

        return $this->extractData($res, true);
    }

//  Get Cash Totals from Prime Trust Custodial Account
    private function getCashTotals($account_id, $jwt_token) {
        $res = $this->doRequest($this->base_URL.'v2/account-cash-totals?account.id='.$account_id, 'get', [], $jwt_token, 'Bearer');

        return json_decode($res)->data[0]->attributes;
    }

//  Get Token
    public function getPrimeToken($user_email, $password) {
        $basic_token = base64_encode($user_email.':'.$password);
        $res = $this->doRequest($this->base_URL.'auth/jwts', 'post', [], $basic_token, 'Basic');

        return $this->extractData($res, false);
    }
}
?>