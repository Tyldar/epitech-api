<?php
namespace EpitechAPI\Tests\Component;

use EpitechAPI\Component\User;
use EpitechAPI\Connector;

class UserTest extends \PHPUnit_Framework_TestCase
{
    private $logins_to_test = array(
        'defrei_r' => array(
            'Raphael',
            'Raphael Defreitas',
            array(
                array('title' => 'Lille', 'name' => 'Lille', 'count' => 533),
                array('title' => 'AER Lille 2017', 'name' => 'aer-lille-2017', 'count' => 5)
            ),
            array('Lille', 'aer-lille-2017'),
            array('Lille', 'AER Lille 2017'),
            'Defreitas',
            'FR/LIL',
            'defrei_r',
            false,
            false,
            'https://cdn.local.epitech.eu/userprofil/profilview/defrei_r.jpg'
        ),
        'wiart_m' => array(
            'Mickael',
            'Mickael Wiart',
            array(
                array('title' => 'Lille', 'name' => 'Lille', 'count' => 533),
                array('title' => 'pedago', 'name' => 'pedago', 'count' => 126),
                array('title' => 'ADM Lille', 'name' => 'ADM_Lille', 'count' => 7),
                array('title' => 'DPRA', 'name' => 'DPRA', 'count' => 19),
            ),
            array('Lille', 'pedago', 'ADM_Lille', 'DPRA'),
            array('Lille', 'pedago', 'ADM Lille', 'DPRA'),
            'Wiart',
            'FR/LIL',
            'wiart_m',
            true,
            false,
            'https://cdn.local.epitech.eu/userprofil/profilview/wiart_m.jpg'
        )
    );

    public function testUserInformation()
    {
        foreach ($this->logins_to_test as $login => $user_data_expected) {
            // Signing in using encrypted credentials
            $connector = new Connector();
            $connector->authenticate(Connector::SIGN_IN_METHOD_CREDENTIALS, $_SERVER['INTRANET_LOGIN'], $_SERVER['INTRANET_PASSWORD']);
            $this->assertTrue($connector->isSignedIn());

            $user = new User($connector, $login);

            $user_data = array(
                $user->getFirstName(),
                $user->getFullName(),
                $user->getGroups(),
                $user->getGroupsName(),
                $user->getGroupsTitle(),
                $user->getLastName(),
                $user->getLocation(),
                $user->getLogin(),
                $user->getIsAdmin(),
                $user->getIsClosed(),
                $user->getPicture(),
            );

            $this->assertEquals($user_data_expected, $user_data);
            $this->assertEquals($connector, $user->getConnector());
        }
    }

    public function testNotFoundUser()
    {
        // Signing in using encrypted credentials
        $connector = new Connector();
        $connector->authenticate(Connector::SIGN_IN_METHOD_CREDENTIALS, $_SERVER['INTRANET_LOGIN'], $_SERVER['INTRANET_PASSWORD']);
        $this->assertTrue($connector->isSignedIn());

        try {
            new User($connector, 'azerty123');
        } catch (\Exception $ex) {
            $this->assertEquals('The user is not found', $ex->getMessage());
        }
    }
}
 