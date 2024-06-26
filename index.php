<?php

namespace App;

include "vendor/autoload.php";
include "functions.php";

$botURL = "http://127.0.0.1:8080/api/Run";
$botSharedSecret = "ThisIsMySecret";
$lastHttpError = "";

$name = new ReplyObject(postToBot("Name"));
$version = new ReplyObject(postToBot("Version"));
$parcel = new ReplyObject(postToBot("ParcelName"));
$simName = new ReplyObject(postToBot("SimName"));
$location = new ReplyObject(postToBot("GetPosition"));
$groupsloader = new ReplyObject(postToBot("ForceLoadGroups"));
$groups = new ReplyObject(postToBot("GetGroupList"));
$sayoutput = new ReplyObject(postToBot("Say", ["channel" => 0, "message" => "Hello world"]));

echo "Name: " . $name->reply . "<br/>
Version: " . $version->reply . " <br/>
Sim: " . $simName->reply . "<br/>
Parcel: " . $parcel->reply . "<br/>
location: " . $location->reply . "<br/>
groupsLoader: " . $groupsloader->reply . "<br/>
groups: " . $groups->reply . "<br/>
say: " . $sayoutput->reply . "<br/>";
