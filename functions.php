<?php

namespace App;

use Exception;
use GuzzleHttp\Client;

function postToBot(string $command, ?array $args = null, bool $wantReply = true): ?string
{
    global $botURL, $botSharedSecret, $lastHttpError;
    $unixtime = time();
    $argsstring = "";
    if ($args != null) {
        $argsstring = implode("~#~", $args);
    }
    $signing = sha1($command . $argsstring . $unixtime . $botSharedSecret);

    $client = new Client();
    $data = [
        'form_params' => [
            "commandName" => $command,
            "args" => $argsstring,
            "signing" => $signing,
            "unixtime" => $unixtime,
        ],
    ];

    try {
        if ($wantReply == false) {
            $client->requestAsync('POST', $botURL, $data);
            return "sent";
        }
        $response = $client->request('POST', $botURL, $data);
        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        }
        $lastHttpError = $response->getStatusCode() . " = " . $response->getBody();
        return null;
    } catch (Exception $e) {
        $lastHttpError = $e->getMessage();
        return null;
    }
}
