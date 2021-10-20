<?php

namespace AmirVahedix\Payment\Gateways\Zarinpal;

use AmirVahedix\Payment\Contracts\GatewayContract;
use AmirVahedix\Payment\Models\Payment;

class ZarinpalAdapter implements GatewayContract
{
    private $url;
    private $client;

    public function request($amount, $description)
    {
        $this->client = new Zarinpal();
        $callback = "http://webamooz.test/test-verify";
        $result = $this->client->request(
            "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $amount, $description, "", "", $callback, true
        );

        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->url = $result['StartPay'];
            return $result["Authority"];
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }

    public function verify(Payment $payment)
    {
        // TODO: Implement verify() method.
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }

    public function getName()
    {
        return 'zarinpal';
    }
}
