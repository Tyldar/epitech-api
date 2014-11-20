<?php
namespace EpitechAPI\Component;

use EpitechAPI\IComponent;
use EpitechAPI\Connector;

/**
 * Class User represent an Epitech user.
 */
class User implements IComponent
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
     * Contains the User classes to avoid multi requests to intranet.
     *
     * @var array
     */
    static protected $users = array();

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
     * @throws \Exception If the Connector is not signed in.
     */
    public function __construct(Connector $connector)
    {
        if (!$connector->isSignedIn())
            throw new \Exception("The Connector is not signed in");

        $this->connector = $connector;

        // Getting the function paremeters
        $parameters = func_get_args();

        if (count($parameters) == 1) {
            // Getting the signed in student

            // If we don't have the signed in user in memory, get it
            if (!array_key_exists('signed_in', User::$users)) {
                $response = $this->connector->request(User::SIGNED_IN_USER_URL);
                User::$users['signed_in'] = $this->parse($response);
                $this->data = User::$users['signed_in'];
                User::$users[$this->getLogin()] = User::$users['signed_in'];
            }

            // Retrieving in memory user
            $this->data = User::$users['signed_in'];
        } else {
            // Getting the specified student
            $login = $parameters[1];

            // If we don't have the specified user in memory, get it
            if (!array_key_exists($login, User::$users)) {
                $response = $this->connector->request(str_replace('{LOGIN}', $login, User::USER_URL));
                User::$users[$login] = $this->parse($response);
            }

            $this->data = User::$users[$login];
        }
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

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
        return $this->getData('picture');
    }

    /**
     * Obtains the login.
     *
     * @return null|string
     */
    public function getLogin()
    {
        return $this->getData('login');
    }

    /**
     * Obtains the first name
     *
     * @return null|string
     */
    public function getFirstName()
    {
        return $this->getData('firstname');
    }

    /**
     * Obtains the last name
     *
     * @return null|string
     */
    public function getLastName()
    {
        return $this->getData('lastname');
    }

    /**
     * Obtains the full name
     *
     * @return null|string
     */
    public function getFullName()
    {
        return $this->getData('title');
    }

    /**
     * Obtains whether is closed account
     *
     * @return null|bool
     */
    public function getIsClosed()
    {
        return $this->getData('close');
    }

    /**
     * Obtains wheter is an admin
     *
     * @return null|bool
     */
    public function getIsAdmin()
    {
        return $this->getData('admin');
    }

    /**
     * Obtains the groups
     *
     * @return null|array
     */
    public function getGroups()
    {
        return $this->getData('groups');
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
                $groups_name[] = $group['name'];
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
                $groups_title[] = $group['title'];
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
        return $this->getData('location');
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
     * Obtains the data for the specified key.
     *
     * @param string $key The data key.
     * @return null|mixed
     */
    protected function getData($key)
    {
        if (array_key_exists($key, $this->data))
            return $this->data[$key];
        return null;
    }

    /**
     * Parse the response
     *
     * @param array $response The connector response
     * @return array The json response
     * @throws \Exception If the response code is not 200 or if the json response is null
     */
    protected function parse($response)
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