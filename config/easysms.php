<?php

/*
 * This file is part of the leonis/easysms-notification-channel.
 * (c) yangliulnn <yangliulnn@163.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
            'errorlog',
        ],
    ],

    // 可用的网关配置
    'gateways' => [
        // 失败日志
        'errorlog' => [
            'channel' => 'smslog',
        ],

        // 阿里云
        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],

        // ...
    ],

    'custom_gateways' => [
        'errorlog' => \Leonis\Notifications\EasySms\Gateways\ErrorLogGateway::class,
        'winic' => \Leonis\Notifications\EasySms\Gateways\WinicGateway::class,
    ],
];
