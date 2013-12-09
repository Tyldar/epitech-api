<?php
function __autoload($class)
{
    $root = dirname(dirname(__FILE__));
    $file = str_replace('EpitechAPI', $root, str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php');
    if (file_exists($file))
        require_once($file);
}