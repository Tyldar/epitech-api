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
     * The url to get module data replacing the {*} variables.
     */
    const URL_EVENT = 'https://intra.epitech.eu/module/{SCHOOL_YEAR}/{CODE_MODULE}/{CODE_INSTANCE}/{CODE_ACTIVITY}/{CODE_EVENT}/?format=json';

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

        print_r($this->data);
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

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

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

}
 