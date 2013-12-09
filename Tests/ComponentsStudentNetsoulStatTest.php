<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php');

$connector = new \EpitechAPI\Connector('defrei_r', '<unix password>');
if ($connector->isSignedIn())
    echo "EpitechAPI::Connector - Authenticated".PHP_EOL;
else
    echo "EpitechAPI::Connector - Authentication failure".PHP_EOL;

$student = new \EpitechAPI\Components\StudentNetsoulStats($connector, 'defrei_r');
print_r($student->getData());

var_dump($student->getRange());

$date = new DateTime();
$date->setTimestamp(time() - 60 * 60 * 25);
var_dump($student->getStatsFromDateTime($date));

var_dump($student->getStatsFromTimestamp(time() - 60 * 60 * 25));