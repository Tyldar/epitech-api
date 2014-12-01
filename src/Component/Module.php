<?php
namespace EpitechAPI\Component;

use EpitechAPI\Connector;
use EpitechAPI\Tool\DataExtractor;

class Module
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The url to get module data replacing the {*} variables.
     */
    const URL_MODULE = 'https://intra.epitech.eu/module/{SCHOOL_YEAR}/{CODE_MODULE}/{CODE_INSTANCE}/?format=json';

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
     * Contains the related activities.
     *
     * @var array
     */
    protected $activities = null;

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
     */
    public function __construct(Connector $connector, $school_year, $code_module, $code_instance)
    {
        $connector->checkSignedIn();
        $this->connector = $connector;

        // Retrieving information about the module
        $url = str_replace(array('{SCHOOL_YEAR}', '{CODE_MODULE}', '{CODE_INSTANCE}'), array($school_year, $code_module, $code_instance), self::URL_MODULE);
        $response = $this->connector->request($url);
        $this->data = DataExtractor::retrieve($response);
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the activities related to this module.
     *
     * @return array
     */
    public function getActivities()
    {
        if ($this->activities == null) {
            $this->activities = array();
            if (($activities = DataExtractor::extract($this->data, array('activites')))) {
                foreach ($activities as $activity_data) {
                    $activity = new Activity($this->connector, $this->getSchoolYear(), $this->getModuleCode(), $this->getInstanceCode(), DataExtractor::extract($activity_data, array('codeacti')));
                    $this->activities[$activity->getActivityCode()] = $activity;
                }
            }
        }
        return $this->activities;
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
 