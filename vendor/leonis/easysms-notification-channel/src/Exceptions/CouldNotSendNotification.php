<?php

/*
 * This file is part of the leonis/easysms-notification-channel.
 * (c) yangliulnn <yangliulnn@163.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Leonis\Notifications\EasySms\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($exception)
    {
        return $exception;
    }
}
