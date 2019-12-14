<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class FundNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $type;
    public $fund_name;

    public function __construct($type, $fund_name)
    {
        $this->type = $type;
        $this->fund_name = $fund_name;
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
        if( $this->type == 'approved' ) {
            return [
            'type' => 'approved',
            'title' => 'Offering Approved!',
            'body' => "Your submission for, {$this->fund_name}, has been approved.
                        You can now complete the process of converting the ownership into digital securities
                        from My Properties.",
            'action_url' => 'https://develop.abstracttokenization.com/properties/approved',
            'created' => Carbon::now()->toIso8601String()
            ];
        } else {
            return [
            'type' => 'rejected',
            'title' => 'Offering Submission Rejected!',
            'body' => "Your real estate offering, {$this->fund_name}, has been rejected. Please revise your submission from
                        My Properties.",
            'action_url' => 'https://develop.abstracttokenization.com/properties/pending',
            'created' => Carbon::now()->toIso8601String()
            ];
        }
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Hello from Laravel!')
            ->icon('/notification-icon.png')
            ->body('Thank you for using our application.')
            ->action('View app', 'view_app')
            ->data(['id' => $notification->id]);
    }
}
