<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php');

$connector = new \EpitechAPI\Connector('defrei_r', '<unix password>');
if ($connector->isSignedIn())
    echo "EpitechAPI::Connector - Authenticated".PHP_EOL;
else
    echo "EpitechAPI::Connector - Authentication failure".PHP_EOL;