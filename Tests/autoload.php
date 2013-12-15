<?php
function __autoload($class)
{
    $file = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Sources'.substr(str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php', 10);
    if (file_exists($file))
        require_once($file);
}