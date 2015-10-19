<?php
namespace EpitechAPI\Component;

use EpitechAPI\Component\Netsoul;
use EpitechAPI\Connector;
use EpitechAPI\Tool\DataExtractor;

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
    const URL_SIGNED_IN_USER = 'https://intra.epitech.eu/user/?format=json';

    /**
     * The url to get data of a user replacing {LOGIN} by the wanted user login.
     */
    const URL_USER = 'https://intra.epitech.eu/user/{LOGIN}/?format=json';

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
     * Contains the data.
     *
     * @var array
     */
    protected $data;

    /**
     * Contains the « Netsoul » component.
     *
     * @var Netsoul
     */
    protected $netsoul = null;

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this component.
     *
     * @param Connector $connector The connector signed in.
     * @param string $login The login of the user to load data, if null, it will take the signed in user.
     * @throws \Exception If the Connector is not signed in.
     */
    public function __construct(Connector $connector, $login = null)
    {
        $connector->checkSignedIn();
        $this->connector = $connector;

        // Retrieving information about the specified user or signed in user
        if ($login == null)
            $url = self::URL_SIGNED_IN_USER;
        else
            $url = str_replace('{LOGIN}', $login, self::URL_USER);
        $response = $this->connector->request($url);
        $this->data = DataExtractor::retrieve($response);
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the intranet data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Obtains the « Netsoul » component.
     *
     * @return Netsoul
     */
    public function getNetsoul()
    {
        if ($this->netsoul == null)
            $this->netsoul = new Netsoul($this->connector);

        return $this->netsoul;
    }

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
     * Obtains the first name.
     *
     * @return null|string
     */
    public function getFirstName()
    {
        return DataExtractor::extract($this->data, array('firstname'));
    }

    /**
     * Obtains the last name.
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
     * Obtains whether is closed account.
     *
     * @return null|bool
     */
    public function getIsClosed()
    {
        return (bool)DataExtractor::extract($this->data, array('close'));
    }

    /**
     * Obtains whether is an admin.
     *
     * @return null|bool
     */
    public function getIsAdmin()
    {
        return (bool)DataExtractor::extract($this->data, array('admin'));
    }

    /**
     * Obtains the groups.
     *
     * @return null|array
     */
    public function getGroups()
    {
        return DataExtractor::extract($this->data, array('groups'));
    }

    /**
     * Obtains the groups name.
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
     * Obtains the groups title.
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
     * Obtains the city code (eg. FR/LIL).
     *
     * @return null|string
     */
    public function getLocation()
    {
        return DataExtractor::extract($this->data, array('location'));
    }

    /**
     * Obtains the promotion
     *
     * @return null|int
     */
    public function getPromotion()
    {
        return DataExtractor::extract($this->data, array('promo'));
    }
}