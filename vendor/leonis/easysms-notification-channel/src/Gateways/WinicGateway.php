<?php

/*
 * This file is part of the leonis/easysms-notification-channel.
 * (c) yangliulnn <yangliulnn@163.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Leonis\Notifications\EasySms\Gateways;

use Illuminate\Support\Str;
use Overtrue\EasySms\Contracts\MessageInterface;
use Overtrue\EasySms\Contracts\PhoneNumberInterface;
use Overtrue\EasySms\Exceptions\GatewayErrorException;
use Overtrue\EasySms\Gateways\Gateway;
use Overtrue\EasySms\Support\Config;
use Overtrue\EasySms\Traits\HasHttpRequest;

class WinicGateway extends Gateway
{
    use HasHttpRequest;

    const ENDPOINT_URL = 'http://service.winic.org:8009/sys_port/gateway/index.asp';
    const INTERNATIONAL_ENDPOINT_URL = 'http://service2.winic.org/service.asmx/SendInternationalMessages';

    /**
     * Send a short message.
     *
     * @param \Overtrue\EasySms\Contracts\PhoneNumberInterface $to
     * @param \Overtrue\EasySms\Contracts\MessageInterface     $message
     * @param \Overtrue\EasySms\Support\Config                 $config
     *
     * @throws \Overtrue\EasySms\Exceptions\GatewayErrorException
     * @return array
     */
    public function send(PhoneNumberInterface $to, MessageInterface $message, Config $config)
    {
        if ($to->getIDDCode() === 86) {
            return $this->mainlandChina($to, $message, $config);
        } else {
            return $this->international($to, $message, $config);
        }
    }

    /**
     * @param \Overtrue\EasySms\Contracts\PhoneNumberInterface $to
     * @param \Overtrue\EasySms\Contracts\MessageInterface     $message
     * @param \Overtrue\EasySms\Support\Config                 $config
     *
     * @throws \Overtrue\EasySms\Exceptions\GatewayErrorException
     * @return array
     */
    private function mainlandChina(PhoneNumberInterface $to, MessageInterface $message, Config $config): array
    {
        $params = [
            'id' => iconv('utf-8', 'gb2312', $config->get('id')),
            'pwd' => $config->get('pwd'),
            'to' => $to->getNumber(),
            'content' => iconv('utf-8', 'gb2312', $message->getContent()),
        ];

        /** @var string $response */
        $response = $this->post(self::ENDPOINT_URL, $params);

        $result = explode('/', $response);

        if ('000' !== $result[0]) {
            throw new GatewayErrorException($response, $result[0], $result);
        }

        return $result;
    }

    /**
     * @param \Overtrue\EasySms\Contracts\PhoneNumberInterface $to
     * @param \Overtrue\EasySms\Contracts\MessageInterface     $message
     * @param \Overtrue\EasySms\Support\Config                 $config
     *
     * @throws \Overtrue\EasySms\Exceptions\GatewayErrorException
     * @return array
     */
    private function international(PhoneNumberInterface $to, MessageInterface $message, Config $config): array
    {
        $params = [
            'uid' => $config->get('id'),
            'pwd' => $config->get('pwd'),
            'tos' => $to->getIDDCode() . $to->getNumber(),
            'msg' => $message->getContent(),
            'otime' => '',
        ];

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        /** @var string $response */
        $response = $this->post(self::INTERNATIONAL_ENDPOINT_URL, $params, $headers);

        if (Str::contains($response[0], '-')) {
            throw new GatewayErrorException($response, $response[0], $response);
        }

        return $response;
    }
}
