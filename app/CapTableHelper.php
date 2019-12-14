<?php

use App\Investment;
use App\Property;
use App\User;
use Illuminate\Support\Facades\DB;

class CapTableHelper
{
    public static function process_cap_table( $property_id, $cap_table, $section = null ) {
        // @TODO support modificaion of an existing cap table
        foreach( $cap_table as $investor ) {
            // Remove whitespaces from email
            $email = preg_replace('/\s+/', '', $investor['email']);
            // Determine if the investor is already a user on our platform.
            $maybe_user = User::where('email', $email)->first();
            $is_new_user = false;

            if( !$maybe_user ) {
                // Create the user and invite them.
                $maybe_user = New User([
                    'email'         => $email,
                    'site_id'       => 2, // @TODO make dynamic
                    'invite_code'   => self::generate_invite_code( 8 ),
                    'profile_image' => 'img/default-profile.img',
                    'type'          => 'investor'
                ]);
                $maybe_user->save();
                $is_new_user = true;
            }
            // Associate the user with the property.
            $payload = [
                'userid'            => $maybe_user->id,
                'property_id'        => $property_id,
                'amount' => $investor['capital'],
                'contributed_at'       => $investor['date'],
                'entity_name'       => $investor['entity_name'],
                'share'             => $investor['stake'],
                'routing_number'    => $investor['routing'],
                'account_number'    => $investor['account'],
                'type'              => $investor['type'],
                'is_sponsor'         => $investor['sponsor'],
                'tax_id'            => $investor['tax_id'],
            ];
            $investment = New Investment($payload);
            $investment->save();

            $site = DB::table( 'sites' )->where( 'id', 2 )->first();
            $invite_link = 'https://' . $site->host . '/invite/' . $maybe_user->invite_code;
            $property = Property::find($property_id);

            // Send the investor an email
            if( $is_new_user && $section === 'investor servicing') {
                $subject = $property->name . ' Is Now Serviced By Abstract Tokenization';
                $message = <<<EOD
{$property->name}, a portfolio property owned by {$investor['entity_name']} is now serviced by the Abstract Tokenization platform! With Abstract, you can efficiently view reports, download tax forms, and more.

To get started, create your account by clicking this link:
$invite_link

-The Abstract Tokenization Team
EOD;
            } if(!$is_new_user && $section === 'investor servicing') {
                $subject = $property->name . ' Is Now Serviced By Abstract Tokenization';
                $invite_link = 'https://' . $site->host . '/login';
                $message = <<<EOD
{$property->name}, a portfolio property owned by {$investor['entity_name']} is now serviced by the Abstract Tokenization platform!

Login to your account to view your reports:
$invite_link

-The Abstract Tokenization Team
EOD;
            }
            if ($section === 'digital security') {
                $subject = $property->name . ' has been Digitized and Is Now Being Serviced by Abstract Tokenization';
                $message = "{$property->name} ownership has been recorded into a digital format -
                you can manage your investment and see performance reporting now from the Abstract Tokenization platform!
                Login to setup your custodial account to receive your digital securities for your investment
                in {$property->name} as well as view performance reporting:

                {$invite_link}";
            }
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $email;
            $subject = $subject;
            $data = [
                'comments' => $message,
                'link_url'=> '',
                'link_str' => ''
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);
        }

        return true;
    }
    public static function process_cap_table_csv($csv_data)
    {
        $cap_table = json_decode($csv_data);
        $headers = $cap_table->original->response->headers;
        $investor_details = [];
        $header_date = dateFromRow($headers[8]);
        $investor_details[] = [
            'entity_name' => $headers[1],
            'tax_id' => $headers[2],
            'account' => $headers[3],
            'routing' => $headers[4],
            'capital' => $headers[5],
            'stake' => $headers[6],
            'date' => $header_date,
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
                    'email' => preg_replace('/\s+/', '', $row[4]),
                    'routing' => $row[5],
                    'account' => $row[6],
                    'type' => $row[7],
                    'sponsor' => false,
                    'tax_id' => '',
                ];
            }
        }

        return $investor_details;
    }

    public static function get_nacha_data($property_id)
    {
        $cap = Investment::where('property_id', $property_id);

        $nacha_data = [];

        foreach ($cap as $investor) {
            $nacha_data[] = [
                'account' => $investor->account_number,
                'routing' => $investor->routing_number,
                'type' => $investor->type,
                'tax_id' => $investor->tax_id,
                'name' => $investor->entity_name,
                'invest_date' => $investor->contributed_at->format('m/d/Y'),
                'amount' => $investor->amount,
            ];
        }

        return $nacha_data;
    }

    public static function get_cap_table($property_id)
    {
        $cap = DB::table('investments')
            ->where('investments.property_id', $property_id)
            ->join('users', 'investments.userid', '=', 'users.id')
            ->get();

        $cap_table = [];

        foreach ($cap as $investor) {
            $cap_table[] = [
                'Investor Name' => $investor->entity_name,
                'Investor Entity' => '',
                'Contribution Date' => $investor->contributed_at->format('m/d/Y'),
                'Contributed Capital' => '$' . number_format($investor->amount),
                'Equity Stake' => $investor->share * 100 . '%',
            ];
        }

        return $cap_table;
    }

    private static function generate_invite_code($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getTotalContributed($userid)
    {
        $totalAmount = DB::table('investments')
            ->selectRaw('SUM(amount) as total_amount')
            ->where('userid', $userid)
            ->groupby('userid')
            ->first();
        return $totalAmount->total_amount;
    }

    public static function getInvestmentDate($userid, $property_id)
    {
        $investment_date = Investment::where('userid', $userid)
            ->where('property_id', $property_id)
            ->first();
        return $investment_date->contributed_at;
    }
}
