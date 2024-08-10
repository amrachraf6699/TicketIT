<?php

namespace App\Traits;


use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;

trait SendSMS
{
    public function sendSMS($phoneNumber, $message)
    {
        $basic = new Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $client = new Client($basic);

        $response = $client->sms()->send(
            new SMS($phoneNumber, config('services.vonage.from'), $message)
        );
    }
}
