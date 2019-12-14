<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class InvestorPropertyNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $type;
    public $property_name;
    public function __construct($type, $property_name)
    {
        $this->type = $type;
        $this->property_name = $property_name;
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
        return [
        'type' => 'create',
        'title' => "{$this->property_name} has been Digitized and Is Now Being Serviced by Abstract Tokenization",
        'body' => "{$this->property_name} ownership has been recorded into a digital format -
                    you can manage your investment and see performance reporting now from the Abstract Tokenization platform!
                    Login to setup your custodial account to receive your digital securities for your investment
                    in {$this->property_name} as well as view  performance reporting.",
        'action_url' => 'https://develop.abstracttokenization.com/login',
        'created' => Carbon::now()->toIso8601String()
        ];
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
