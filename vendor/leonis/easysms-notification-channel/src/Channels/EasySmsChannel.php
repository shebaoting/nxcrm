<?php

/*
 * This file is part of the leonis/easysms-notification-channel.
 * (c) yangliulnn <yangliulnn@163.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Leonis\Notifications\EasySms\Channels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Leonis\Notifications\EasySms\Exceptions\CouldNotSendNotification;

class EasySmsChannel
{
    /**
     * Send the given notification.
     *
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if ($notifiable instanceof Model) {
            $to = $notifiable->routeNotificationForEasySms($notification);
        } elseif ($notifiable instanceof AnonymousNotifiable) {
            $to = $notifiable->routes[__CLASS__];
        }

        $message = $notification->toEasySms($notifiable);

        try {
            app()->make('easysms')->send($to, $message);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
