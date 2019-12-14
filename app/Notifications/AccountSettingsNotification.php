<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class AccountSettingsNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
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
      //to approve or reject from the abstract accountsetting email sent.
        if( $this->type == 'approved' ) {
            return [
            'type' => 'approved',
            'title' => 'Sponsor Approved!',
            'body' => 'Congratulations, you have been approved as a Sponsor.
                        Next click the Create Digital Security button to submit info for a property
                        or a fund for which you want to create a digital security.',
            'action_url' => 'https://develop.abstracttokenization.com/security-flow/step-1/choose',
            'created' => Carbon::now()->toIso8601String()
            ];
        } else {
            return [
            'type' => 'rejected',
            'title' => 'Sponsor Submission Rejected!',
            'body' => 'Unfortunately, your submission has been rejected.',
            'action_url' => 'https://develop.abstracttokenization.com/account-settings/verification',
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
