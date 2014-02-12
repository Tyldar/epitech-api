<?php
namespace Tests;

use EpitechAPI\Connector;

class ConnectorTest extends \PHPUnit_Framework_TestCase {
    public function testSignedIn() {
        $c = new Connector('toto', 'titi');
    }
}
 