<?php

namespace App\Notifications;

use App\Models\CrmContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Leonis\Notifications\EasySms\Channels\EasySmsChannel;
use Leonis\Notifications\EasySms\Messages\EasySmsMessage;

class ContractTime extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CrmContract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [EasySmsChannel::class, 'database'];
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


    public function toDatabase($notifiable)
    {
        return [
           'customer_name' => $this->contract->CrmCustomer->name,
           'expiretime' => $this->contract->expiretime,
           'contract_id' => $this->contract->id,
        ];
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
            ->setTemplate(admin_setting_array('reminder')['contract_admin_smscode'])
            ->setData([
                'customer' => $this->contract->CrmCustomer->name,
                'name' => $this->contract->CrmCustomer->adminUser->name,
                'time' => $this->contract->expiretime
            ]);
    }
}
