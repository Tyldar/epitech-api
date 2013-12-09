<?php
namespace EpitechAPI\Components;
use EpitechAPI\Connector;
use EpitechAPI\Settings;

/**
 * Class StudentNetsoulStats provides information about the Netsoul stats from a student.
 * @package EpitechAPI\Components
 * @author Raphael DE FREITAS <raphythegeek@gmail.com>
 */
class StudentNetsoulStats
{
    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the connector.
     * @var \EpitechAPI\Connector
     */
    protected $_connector;

    /**
     * Contains the student data
     * @var array
     */
    protected $_data;

    # # # # # # # # # # # # # # # # # # # #
    #             Magic Methods           #
    # # # # # # # # # # # # # # # # # # # #


    /**
     * Initializes a new instance of this class and retrieves the netsoul stats of the specified student login.
     * @param Connector $connector The connector.
     * @param string $login The student login.
     * @throws \Exception If the connector is not signed in.
     */
    public function __construct(Connector $connector, $login)
    {
        // Checking the authentication
        if ($connector->isSignedIn() === false)
            throw new \Exception('EpitechAPI: You must be authenticated');

        // Initializing the attributes
        $this->_connector = $connector;
        $this->_data = array();

        // Parsing the data
        $this->parse($login);
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    # # # # # # # # # # # # # # # # # # # #
    #          Protected Methods          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Parses the cURL request of the specified student login.
     * @param string $login The student login.
     * @throws \Exception If json_decode() fails.
     */
    protected function parse($login)
    {
        // Parsing the URL
        $url = str_replace('{LOGIN}', $login, Settings::URL_USER_NETSOUL_STATS);

        // Parsing the request content
        $json_content = $this->_connector->request($url);
        $json_content = str_replace("// Epitech JSON webservice ...\n", "", $json_content);

        // Setting the user data
        if (($this->_data = json_decode($json_content, true)) === null)
            throw new \Exception('EpitechAPI::User: The JSON content is not valid: '.json_last_error_msg());
    }

    # # # # # # # # # # # # # # # # # # # #
    #         Getters and Setters         #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the student netsoul stat data.
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Obtains an array of the date range of the netsoul stats.
     * @return array The array (start => DateTime object, end => DateTime object) of the range.
     */
    public function getRange()
    {
        $range = array();

        // Calculating the range
        if (($count = count($this->_data)) >= 1) {

            $start = new \DateTime();
            $start->setTimestamp($this->_data[0][0]);

            $end = new \DateTime();
            $start->setTimestamp($this->_data[$count - 1][0]);

            $range = array(
                'start' => $start,
                'end' => $end
            );
        }

        return $range;
    }

    /**
     * Obtains the array of the netsoul stats.
     * @return array The array (midnight timestamp => array()) of the netsoul stats.
     */
    public function getStats()
    {
        $stats = array();

        // Making the array of the stats
        foreach ($this->_data as $data) {
            $stats[$data[0]] = array(
                'time_idle' => $data[2],
                'timeout_active' => $data[3],
                'timeout_idle' => $data[4],
                'time_average' => $data[5]
            );
        }

        return $stats;
    }

    /**
     * Obtains the data of the specified midnight timestamp.
     * @param int $midnight_timestamp The midnight timestamp.
     * @return null|array
     */
    public function getDataFromMidnightTimestamp($midnight_timestamp)
    {
        // Browsing the data to find the midnight timestamp
        foreach ($this->_data as $data)
            if ($data[0] === $midnight_timestamp)
                return $data;

        return null;
    }

    /**
     * Obtains the netsoul stats from the specified timestamp.
     * @param int $timestamp The midnight timestamp.
     * @return array|null
     */
    public function getStatsFromTimestamp($timestamp)
    {
        // Getting the stats for the midnight timestamp
        $midnight_timestamp = strtotime('today', $timestamp);
        if (($data = $this->getDataFromMidnightTimestamp($midnight_timestamp)) === null)
            return null;

        // Making the array
        $stats = array(
            'time_active' => $data[1],
            'time_idle' => $data[2],
            'timeout_active' => $data[3],
            'timeout_idle' => $data[4],
            'time_average' => $data[5]
        );

        return $stats;
    }

    /**
     * Obtains the netsoul stats form the specified DateTime
     * @param \DateTime $date The DateTime.
     * @return array|null
     */
    public function getStatsFromDateTime(\DateTime $date)
    {
        // Getting the stats for the midnight timestamp
        $midnight_timestamp = strtotime('today', $date->getTimestamp());
        if (($data = $this->getDataFromMidnightTimestamp($midnight_timestamp)) === null)
            return null;

        // Making the array
        $stats = array(
            'time_active' => $data[1],
            'time_idle' => $data[2],
            'timeout_active' => $data[3],
            'timeout_idle' => $data[4],
            'time_average' => $data[5]
        );

        return $stats;
    }

} 