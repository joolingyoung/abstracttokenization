<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DelayMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $to_address;
    public $data;
    public $type;
    public function __construct($type, $to_address, $data)
    {
        $this->type = $type;
        $this->to_address = $to_address;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 'newDistribution') {
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $this->to_address;
            $subject = "You've Received a Distribution";
            $data = [
                'comments' => "You have received a distribution from {$this->data} and
                    your performance & distributions summary has been updated.
                    Pleaae vist My Investments to view:
                    https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment",
                'link_url'=> '',
                'link_str' => ''
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);
        } elseif ( $this->type == 'newReport' ) {
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $this->to_address;
            $subject = "Your Investment Report is Ready";
            $data = [
                'comments' => "Your investment report for {$this->data} is ready to view and download.
                    Please visit My Investments to select and view your report:
                    https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment",
                'link_url'=> '',
                'link_str' => ''
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);
        } elseif ( $this->type == 'newTax' ) {
            $from_address = 'no-reply@abstracttokenization.com';
            $from_name = 'Abstract Tokenization';
            $to_address = $this->to_address;
            $subject = "New Tax Document is Ready";
            $data = [
                'comments' => "A tax document for {$this->data} has been added to your account.
                    You can view from the Tax Documents section under My Investments -
                    https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment",
                'link_url'=> '',
                'link_str' => ''
            ];
            $view = 'emails.client-mail';
            sendMail($from_address, $from_name, $to_address, $subject, $data, $view);
        }
    }
}
