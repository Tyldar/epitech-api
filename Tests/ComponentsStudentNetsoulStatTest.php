<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php');

$connector = new \EpitechAPI\Connector('defrei_r', '<unix password>');
if ($connector->isSignedIn())
    echo "EpitechAPI::Connector - Authenticated".PHP_EOL;
else
    echo "EpitechAPI::Connector - Authentication failure".PHP_EOL;

$netsoul = new \EpitechAPI\Components\StudentNetsoulStats($connector, 'defrei_r');
print_r($netsoul);

var_dump($netsoul->getRange());

$date = new DateTime();
$date->setTimestamp(time() - 60 * 60 * 25);
var_dump($netsoul->getStatsFromDateTime($date));

var_dump($netsoul->getStatsFromTimestamp(time() - 60 * 60 * 25));


$start = time() - 60 * 60 * 24 * 7;
$end = time();
print_r($netsoul->getStatsBetweenTimeStamp($start, $end));