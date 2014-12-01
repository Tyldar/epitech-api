<?php
namespace EpitechAPI\Component;

use EpitechAPI\Connector;
use EpitechAPI\Tool\DataExtractor;

class Activity
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The url to get activity data replacing the {*} variables.
     */
    const URL_ACTIVITY = 'https://intra.epitech.eu/module/{SCHOOL_YEAR}/{CODE_MODULE}/{CODE_INSTANCE}/{CODE_ACTIVITY}/?format=json';

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
     * Contains the related module.
     *
     * @var Module
     */
    protected $module = null;

    /**
     * Contains the related events.
     *
     * @var array
     */
    protected $events = null;

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
     */
    public function __construct(Connector $connector, $school_year, $code_module, $code_instance, $code_activity)
    {
        $connector->checkSignedIn();
        $this->connector = $connector;

        // Retrieving information about the activity
        $url = str_replace(array('{SCHOOL_YEAR}', '{CODE_MODULE}', '{CODE_INSTANCE}', '{CODE_ACTIVITY}'), array($school_year, $code_module, $code_instance, $code_activity), self::URL_ACTIVITY);
        $response = $this->connector->request($url);
        $this->data = DataExtractor::retrieve($response);
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the related events.
     *
     * @return array
     */
    public function getEvents()
    {
        if ($this->events == null) {
            $this->events = array();
            if (($events = DataExtractor::extract($this->data, array('events')))) {
                foreach ($events as $event_data) {
                    $event = new Event($this->connector, $this->getSchoolYear(), $this->getModuleCode(), $this->getInstanceCode(), $this->getActivityCode(), DataExtractor::extract($event_data, array('code')));
                    $this->events[$event->getEventCode()] = $event;
                }
            }
        }

        return $this->events;
    }

    /**
     * Obtains the related module.
     *
     * @return Module
     */
    public function getModule()
    {
        if ($this->module == null)
            $this->module = new Module($this->connector, $this->getSchoolYear(), $this->getModuleCode(), $this->getInstanceCode());

        return $this->module;
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
     * Obtains the title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return DataExtractor::extract($this->data, array('title'));
    }

    /**
     * Obtains the description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return DataExtractor::extract($this->data, array('description'));
    }
}
 