<?php

use App\Investment;
use Illuminate\Support\Facades\Storage;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;


class HistoricTableHelper
{
    /**
     * Get Cap Table data
     * @param String $type
     * @param String $userid
     */
    public static function get_cap_table_data($type, $id, $userid)
    {
        if (!isset($type) || !isset($userid)) {
            return false;
        }

        $data = \PropertyDataHelper::getPropertyData($type, $id, $userid);

        return !empty($data->captables) ? $data->captables : '';
    }


    /**
     * Register the Data per Invester
     */
    public static function save_invester_monthly_data($type, $userid)
    {
        try { } catch (Exception $e) { }
    }

    /**
     * Process the file
     */
    public static function process_file_data($data, $remote=true)
    {

        try {
            if ( gettype($data) == "array" && count($data) <= 0) {
                return;
            }
            $tmpFilePath = storage_path('app/').rand();

            touch($tmpFilePath);

            $writer = WriterEntityFactory::createCSVWriter();
            $writer->setShouldAddBOM(false);
            $writer->openToFile($tmpFilePath);
            /** Create a style with the StyleBuilder **/
            /* $wrap = (new StyleBuilder())
            ->setShouldWrapText()
            ->build(); */

            // var_dump( $captable_data ); exit();

            /* Header part */
            $writer->addRow(WriterEntityFactory::createRowFromArray(array(
                'Company Name'
            )));
            $writer->addRow(WriterEntityFactory::createRowFromArray(array(
                $data['company_name']
            )));
            $writer->addRow(WriterEntityFactory::createRow(array())); // Emply row

            /* Body part */
            $writer->addRow(WriterEntityFactory::createRow(array(
                WriterEntityFactory::createCell('Credit/Distribution Accounts')
            )));

            $writer->addRow(WriterEntityFactory::createRowFromArray(array(
                'ABA/TRC Routing #', 'Account #', 'Account Type', 'Name', 'Distribution Amount', 'Total Distribution'
            )));

            $distributions_data = $data['distributions'];
            $total_amount = $data['total_amount'];

            foreach ($distributions_data as $distribution ) {
                $writer->addRow(WriterEntityFactory::createRowFromArray(array(
                        $distribution['routing_number'],
                        $distribution['account_number'],
                        $distribution['account_type'],
                        $distribution['investor_name'],
                        "$".number_format( $distribution['dist_amount'], 2),
                    ))
                );
            }
            $writer->addRow(
                WriterEntityFactory::createRowFromArray(['','','','','', "$".number_format($total_amount, 2)])
            );
            $writer->close();
            // End: Excel File Data Create
            if ($remote) {
                Storage::disk('s3')->put($data['file_path'], file_get_contents($tmpFilePath));
                Storage::disk('local')->delete($tmpFilePath);
                return $data['file_path'];
            } else {
                $f = file_get_contents($tmpFilePath);
                Storage::disk('local')->delete($tmpFilePath);
                return $f;
            }

        } catch (Exception $e) {
            print_r('HistoricTableHelper::process_file_data happened error');
            Log::error($e);
            return false;
        }
    }

    /**
     * Calculate the distribution per investor monthly
     */
    public static function calculate_distribution($property_id, $start_date, $end_date, $user_id, $total_amount)
    {
        try {
            $calc_distribution = 0;
            $max_day = date('t', strtotime($start_date));
            if (is_null($end_date)) $end_date = date('Y-m-'. $max_day, strtotime($start_date));
            $from = $start_date;
            $to   = \Carbon\Carbon::parse($end_date);

            $previous = Investment::where('userid', $user_id)
                ->where('property_id', $property_id)
                ->where('contributed_at', '<', $from)
                ->orderBy('contributed_at', 'desc')
                ->first();

            $new = Investment::where('userid', $user_id)
                ->where('property_id', $property_id)
                ->whereBetween('contributed_at', [$from, $to])
                ->orderBy('contributed_at', 'desc')
                ->first();

            $total_days = $from->diffInDays($to);

            if (!is_null($new)) {

                $new_date  = $new->contributed_at;
                $old_days   = $from->diffInDays($new_date);
                $new_days   = $new_date->diffInDays($to);

                $old_distributions = isset($previous) ? $total_amount * $previous->share * $old_days / $total_days : 0;
                $new_distributions = $total_amount * $new->share * $new_days / $total_days;

                $calc_distribution = $old_distributions + $new_distributions;
            } else {
                $calc_distribution = isset($previous) ? $total_amount * $previous->share : 0;
            }
            return $calc_distribution;
        } catch (Exception $e) {
            \Log::error($e);
            return 0;
        }
    }
}
