# EasySms Notification Channel for Laravel

使用 [overtrue/easy-sms](https://github.com/overtrue/easy-sms) 发送 Laravel 消息通知。

## 安装

```shell
$ composer require leonis/easysms-notification-channel
```

## 配置

1. 在 config/app.php 注册 ServiceProvider (Laravel 5.5 + 无需手动注册)：

    ```php
    'providers' => [
        // ...
        Leonis\Notifications\EasySms\EasySmsChannelServiceProvider::class,
    ],
    ```

2. 创建配置文件：

    ```shell
    $ php artisan vendor:publish --provider="Leonis\Notifications\EasySms\EasySmsChannelServiceProvider"
    ```
    
3. 修改应用根目录下的 config/easysms.php 中对应的参数即可。

## 使用

1. 创建通知：

    ```php
    <?php

    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Notification;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Leonis\Notifications\EasySms\Channels\EasySmsChannel;
    use Leonis\Notifications\EasySms\Messages\EasySmsMessage;

    class VerificationCode extends Notification
    {
        use Queueable;

        public function via($notifiable)
        {
            return [EasySmsChannel::class];
        }

        public function toEasySms($notifiable)
        {
            return (new EasySmsMessage)
                ->setContent('您的验证码为: 6379')
                ->setTemplate('SMS_001')
                ->setData(['code' => 6379]);
        }
    }
    ```
    
2. 向已绑定手机号用户发送通知。
    
    用户模型：
    ```php
    <?php
    
    namespace App;
    
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Overtrue\EasySms\PhoneNumber;
    
    class User extends Authenticatable
    {
        use Notifiable;
     
        public function routeNotificationForEasySms($notification)
        {
            return new PhoneNumber($this->number, $this->area_code);
        }
    }
    ```
    
    发送通知：
    
    ```php
    // 使用 Notifiable Trait
    $user->notify(new VerificationCode());
    // 使用 Notification Facade
    Notification::send($user, new VerificationCode());
    ```

3. 向未注册用户或未绑定手机号用户发送通知。
    
    ```php
    Notification::route(
        EasySmsChannel::class,
        new PhoneNumber(13333333333, 86)
    )->notify(new VerificationCode());
    ```

## License

[MIT](https://github.com/yl/easysms-notification-channel/blob/master/LICENSE)
