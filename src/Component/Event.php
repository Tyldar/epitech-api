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

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

}
 