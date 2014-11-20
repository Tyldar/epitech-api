<?php
namespace EpitechAPI\Tests;

use EpitechAPI\Component\User;
use EpitechAPI\Connector;

class ConnectorTest extends \PHPUnit_Framework_TestCase
{

    static protected $phpsessids = array();

    public function testAuthenticationWithCredentials()
    {
        // Signing in using encrypted credentials
        $connector = new Connector();
        $connector->authenticate(Connector::SIGN_IN_METHOD_CREDENTIALS, $_SERVER['INTRANET_LOGIN'], $_SERVER['INTRANET_PASSWORD']);
        $this->assertTrue($connector->isSignedIn());

        // Checking the signed in user
        $signed_in_user = $connector->getUser();
        $this->assertTrue($signed_in_user instanceof User);
        $this->assertEquals($_SERVER['INTRANET_LOGIN'], $signed_in_user->getLogin());

        // Getting the PHPSESSID
        $this->assertNotNull($connector->getPHPSESSID());
        self::$phpsessids[] = $connector->getPHPSESSID();
    }

    public function testAuthenticationWithAutologinLink()
    {
        // Signing in using encrypted autologin link
        $connector = new Connector();
        $connector->authenticate(Connector::SIGN_IN_METHOD_AUTOLOGIN_LINK, $_SERVER['INTRANET_AUTOLOGIN_LINK']);
        $this->assertTrue($connector->isSignedIn());

        // Checking the signed in user
        $signed_in_user = $connector->getUser();
        $this->assertTrue($signed_in_user instanceof User);
        $this->assertEquals($_SERVER['INTRANET_LOGIN'], $signed_in_user->getLogin());

        // Getting the PHPSESSID
        $this->assertNotNull($connector->getPHPSESSID());
        self::$phpsessids[] = $connector->getPHPSESSID();
    }

    public function testAuthenticationWithPHPSESSID()
    {
        // Here we have 2 PHPSESSID
        $this->assertEquals(2, count(self::$phpsessids));

        foreach (self::$phpsessids as $phpsessid) {
            // Signing in using the PHPSESSID provided by the previous way of authentication
            $connector = new Connector();
            $connector->authenticate(Connector::SIGN_IN_METHOD_PHPSESSID, $phpsessid);
            $this->assertTrue($connector->isSignedIn());

            // Checking the signed in user
            $signed_in_user = $connector->getUser();
            $this->assertTrue($signed_in_user instanceof User);
            $this->assertEquals($_SERVER['INTRANET_LOGIN'], $signed_in_user->getLogin());

            // Checking the PHPSESSID
            $this->assertEquals($phpsessid, $connector->getPHPSESSID());
            $this->assertNotNull($connector->getPHPSESSID());
        }
    }

    public function testAuthenticationWithInvalidMethod()
    {
        $connector = new Connector();
        try {
            $connector->authenticate('invalid method');
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \InvalidArgumentException);
        }
    }
}
 