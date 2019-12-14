<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class GeneralDelayNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $type;
    public $data;

    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', WebPushChannel::class];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
		if( $this->type == 'newDistribution' ) {
			return [
                'type' => 'newDistribution',
                'title' => "You've Received a Distribution",
                'body' => "You have received a distribution from {$this->data} and
                            your performance & distributions summary has been updated.
                            Pleaae visit My Investments to view.",
                'action_url' => 'https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment',
                'created' => Carbon::now()->toIso8601String()
			];
		} elseif( $this->type == 'newReport' ) {
			return [
                'type' => 'newReport',
                'title' => "Your Investment Report is Ready",
                'body' => "Your investment report for {$this->data} is ready to view and download from My Investments",
                'action_url' => 'https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment',
                'created' => Carbon::now()->toIso8601String()
			];
        } elseif( $this->type == 'newTax' ) {
			return [
                'type' => 'newTax',
                'title' => "New Tax Document is Ready",
                'body' => "A tax document for {$this->data} has been added to your account.
                        Please click on My Investments and view from the Tax Documents section",
                'action_url' => 'https://acg.develop.abstracttokenization.com/investor-servicing/choose-investment',
                'created' => Carbon::now()->toIso8601String()
			];
		}
    }
}
