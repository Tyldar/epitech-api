<?php
namespace EpitechAPI\Component;

use EpitechAPI\IComponent;
use EpitechAPI\Connector;
use EpitechAPI\Tools\DataExtractor;

/**
 * Class User represent an Epitech user.
 */
class User
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The url to get data of the signed in user.
     */
    const SIGNED_IN_USER_URL = 'https://intra.epitech.eu/user/?format=json';

    /**
     * The url to get data of a user replacing {LOGIN} by the wanted user login.
     */
    const USER_URL = 'https://intra.epitech.eu/user/{LOGIN}/?format=json';

    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the Connector.
     *
     * @var \EpitechAPI\Connector
     */
    protected $connector;

    /**
     * Contains the user data.
     *
     * @var array
     */
    protected $data;

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this component taking the Connector to interact with Epitech's intranet.
     *
     * @param Connector $connector The connector signed in.
     * @param string $login The login of the user to load data.
     * @throws \Exception If the Connector is not signed in.
     */
    public function __construct(Connector $connector, $login = null)
    {
        if (!$connector->isSignedIn())
            throw new \Exception("The Connector is not signed in");

        $this->connector = $connector;

        if ($login == null) {
            // If we don't have the signed in user in memory, get it
            $response = $this->connector->request(User::SIGNED_IN_USER_URL);
            $this->data = $this->check($response);
        } else {
            // If we don't have the specified user in memory, get it
            $response = $this->connector->request(str_replace('{LOGIN}', $login, User::USER_URL));
            $this->data = $this->check($response);
        }
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the picture Url.
     *
     * @return null|string
     */
    public function getPicture()
    {
        return DataExtractor::extract($this->data, array('picture'));
    }

    /**
     * Obtains the login.
     *
     * @return null|string
     */
    public function getLogin()
    {
        return DataExtractor::extract($this->data, array('login'));
    }

    /**
     * Obtains the first name
     *
     * @return null|string
     */
    public function getFirstName()
    {
        return DataExtractor::extract($this->data, array('firstname'));
    }

    /**
     * Obtains the last name
     *
     * @return null|string
     */
    public function getLastName()
    {
        return DataExtractor::extract($this->data, array('lastname'));
    }

    /**
     * Obtains the full name
     *
     * @return null|string
     */
    public function getFullName()
    {
        return DataExtractor::extract($this->data, array('title'));
    }

    /**
     * Obtains whether is closed account
     *
     * @return null|bool
     */
    public function getIsClosed()
    {
        return (bool)DataExtractor::extract($this->data, array('close'));
    }

    /**
     * Obtains wheter is an admin
     *
     * @return null|bool
     */
    public function getIsAdmin()
    {
        return (bool)DataExtractor::extract($this->data, array('admin'));
    }

    /**
     * Obtains the groups
     *
     * @return null|array
     */
    public function getGroups()
    {
        return DataExtractor::extract($this->data, array('groups'));
    }

    /**
     * Obtains the groups name
     *
     * @return array|null
     */
    public function getGroupsName()
    {
        if (($groups = $this->getGroups())) {
            $groups_name = array();
            foreach ($groups as $group)
                $groups_name[] = DataExtractor::extract($group, array('name'));
            return $groups_name;
        }
        return null;
    }

    /**
     * Obtains the groups title
     *
     * @return array|null
     */
    public function getGroupsTitle()
    {
        if (($groups = $this->getGroups())) {
            $groups_title = array();
            foreach ($groups as $group)
                $groups_title[] = DataExtractor::extract($group, array('title'));
            return $groups_title;
        }
        return null;
    }

    /**
     * Obtains the city code (eg. FR/LIL)
     *
     * @return null|string
     */
    public function getLocation()
    {
        return DataExtractor::extract($this->data, array('location'));
    }

    /**
     * Obtains the Connector.
     *
     * @return Connector
     */
    public function getConnector()
    {
        return $this->connector;
    }

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Checks the response and returns its json content as array
     *
     * @param array $response The connector response
     * @return array The json response
     * @throws \Exception If the response code is not 200 or if the json response is null
     */
    protected function check($response)
    {
        // Shortcuts
        $code = $response['code'];
        $json = $response['json'];

        // If the response code is 404, the student is not found
        if ($code == 404)
            throw new \Exception('The user is not found');

        // If the response code is not 200, the intranet is down ! Again...
        if ($code !== 200)
            throw new \Exception('The HTTP response is not 200... Maybe Intranet is down ?!');

        // If the json is null, the response is not a valid json
        if ($json == null)
            throw new \Exception('Cannot parse the json response, bad formatted ?!');

        return $json;
    }
}