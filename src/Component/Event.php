<?php
namespace EpitechAPI\Component;

use EpitechAPI\Connector;
use EpitechAPI\Tool\DataExtractor;

class Event
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The url to get event data replacing the {*} variables.
     */
    const URL_EVENT = 'https://intra.epitech.eu/module/{SCHOOL_YEAR}/{CODE_MODULE}/{CODE_INSTANCE}/{CODE_ACTIVITY}/{CODE_EVENT}/?format=json';

    /**
     * The url to get the users registered to this event.
     */
    const URL_USER_REGISTERED = 'https://intra.epitech.eu/module/{SCHOOL_YEAR}/{CODE_MODULE}/{CODE_INSTANCE}/{CODE_ACTIVITY}/{CODE_EVENT}/registered?format=json';

    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the Connector.
     *
     * @var Connector
     */
    protected $connector = null;

    /**
     * Contains the related activity.
     *
     * @var Activity
     */
    protected $activity = null;

    /**
     * Contains the login of the registered users.
     *
     * @var array
     */
    protected $registered_users_login = null;

    /**
     * Contains the User object of the registered users.
     *
     * @var array
     */
    protected $registered_users = null;

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this component.
     *
     * @param Connector $connector The Connector signed in.
     * @param int $school_year The school year.
     * @param string $code_module The module code.
     * @param string $code_instance The instance code.
     * @param string $code_activity The activity code.
     * @param string $code_event The event code.
     */
    public function __construct(Connector $connector, $school_year, $code_module, $code_instance, $code_activity, $code_event)
    {
        $connector->checkSignedIn();
        $this->connector = $connector;

        // Retrieving information about the activity
        $url = str_replace(array('{SCHOOL_YEAR}', '{CODE_MODULE}', '{CODE_INSTANCE}', '{CODE_ACTIVITY}', '{CODE_EVENT}'), array($school_year, $code_module, $code_instance, $code_activity, $code_event), self::URL_EVENT);
        $response = $this->connector->request($url);
        $this->data = DataExtractor::retrieve($response);
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the users registered to this event.
     *
     * @param bool $as_object Whether the return type is an array of logins or an array of object User.
     * @return array
     */
    public function getRegisteredUsers($as_object = false)
    {
        if ($this->registered_users_login == null) {
            $this->registered_users_login = array();
            $url = str_replace(array('{SCHOOL_YEAR}', '{CODE_MODULE}', '{CODE_INSTANCE}', '{CODE_ACTIVITY}', '{CODE_EVENT}'), array($this->getSchoolYear(), $this->getModuleCode(), $this->getInstanceCode(), $this->getActivityCode(), $this->getEventCode()), self::URL_USER_REGISTERED);
            $response = $this->connector->request($url);
            $registered_users = DataExtractor::retrieve($response);

            foreach ($registered_users as $registered_user)
                $this->registered_users_login[$registered_user['login']] = $registered_user['login'];
        }

        if ($as_object) {
            if ($this->registered_users == null) {
                $this->registered_users = array();

                foreach ($this->registered_users_login as $login)
                    $this->registered_users[$login] = new User($this->connector, $login);
            }

            return $this->registered_users;
        }

        return $this->registered_users_login;
    }

    /**
     * Obtains the related activity.
     *
     * @return Activity
     */
    public function getActivity()
    {
        if ($this->activity == null)
            $this->activity = new Activity($this->connector, $this->getSchoolYear(), $this->getModuleCode(), $this->getInstanceCode(), $this->getActivityCode());

        return $this->activity;
    }

    /**
     * Obtains the school year.
     *
     * @return int|null
     */
    public function getSchoolYear()
    {
        return DataExtractor::extract($this->data, array('scolaryear'));
    }

    /**
     * Obtains the module code.
     *
     * @return string|null
     */
    public function getModuleCode()
    {
        return DataExtractor::extract($this->data, array('codemodule'));
    }

    /**
     * Obtains the instance code.
     *
     * @return string|null
     */
    public function getInstanceCode()
    {
        return DataExtractor::extract($this->data, array('codeinstance'));
    }

    /**
     * Obtains the activity code.
     *
     * @return string|null
     */
    public function getActivityCode()
    {
        return DataExtractor::extract($this->data, array('codeacti'));
    }

    /**
     * Obtains the event code.
     *
     * @return string|null
     */
    public function getEventCode()
    {
        return DataExtractor::extract($this->data, array('codeevent'));
    }

    /**
     * Obtains the title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return DataExtractor::extract($this->data, array('acti_title'));
    }

    /**
     * Obtains the description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return DataExtractor::extract($this->data, array('acti_description'));
    }
}
 