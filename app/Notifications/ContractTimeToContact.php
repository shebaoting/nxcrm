<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\CrmContact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Leonis\Notifications\EasySms\Channels\EasySmsChannel;
use Leonis\Notifications\EasySms\Messages\EasySmsMessage;

class ContractTimeToContact extends Notification
{
    use Queueable;
    private $user,$time;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CrmContact $user,$time)
    {
        $this->user = $user;
        $this->time = $time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [EasySmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            //
        ];
    }

    public function toEasySms($notifiable)
    {
        return (new EasySmsMessage)
            ->setContent('您的验证码为: 6379')
            ->setTemplate(admin_setting_array('reminder')['contract_user_smscode'])
            ->setData([
                'name' => $this->user->name,
                'time' => $this->time,
                'tel' => admin_setting('company_phone')
            ]);
    }
}
