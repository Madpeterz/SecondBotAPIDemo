<?php

namespace App;

class ReplyObject
{
    public string $command = "";
    public array $args = [];
    public bool $status = false;
    public string $reply = "";
    public function __construct(?string $data)
    {
        if ($data == null) {
            return;
        }
        $data = trim($data, '"');
        $dataJson = json_decode($data, true);
        if (is_array($dataJson) == false) {
            $this->reply = "Unable to unpack data: " . $data;
            return;
        }
        if (array_key_exists("Value", $dataJson) == false) {
            $this->reply = "Value key is missing from data: " . $data;
            return;
        }
        $dataJson = json_decode($dataJson["Value"], true);
        if (is_array($dataJson) == false) {
            $this->reply = "Unable to unpack Value from data: " . $data;
            return;
        }
        if (array_key_exists("command", $dataJson) == false) {
            return;
        }
        $this->command = $dataJson["command"];
        $this->args = $dataJson["args"];
        $this->status = $dataJson["status"];
        $this->reply = $dataJson["reply"];
    }
}
