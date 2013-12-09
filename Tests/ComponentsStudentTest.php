<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php');

$connector = new \EpitechAPI\Connector('defrei_r', '<unix password>');
if ($connector->isSignedIn())
    echo "EpitechAPI::Connector - Authenticated".PHP_EOL;
else
    echo "EpitechAPI::Connector - Authentication failure".PHP_EOL;

$student = new \EpitechAPI\Components\Student($connector, 'mestag_a');
print_r($student->getData());

var_dump($student->getLogin());
echo PHP_EOL;
var_dump($student->getLastName());
echo PHP_EOL;
var_dump($student->getFirstName());
echo PHP_EOL;
var_dump($student->getGPA());
echo PHP_EOL;
var_dump($student->getLocation());
echo PHP_EOL;
var_dump($student->getMiniaturePictureUrl());
echo PHP_EOL;
var_dump($student->getPictureUrl());
echo PHP_EOL;
var_dump($student->getPromotion());
echo PHP_EOL;
var_dump($student->isCloseAccount());
echo PHP_EOL;
var_dump($student->getYear());
echo PHP_EOL;
var_dump($student->getSemester());
echo PHP_EOL;