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

    protected $_stats;

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
        $this->_stats = null;

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
        // Making the stats if it's the first time
        if ($this->_stats === null) {
            $this->_stats = array();

            // Making the array of the stats
            foreach ($this->_data as $data) {
                $this->_stats[$data[0]] = array(
                    'time_idle' => $data[2],
                    'timeout_active' => $data[3],
                    'timeout_idle' => $data[4],
                    'time_average' => $data[5]
                );
            }
        }

        return $this->_stats;
    }

    /**
     * Obtains the netsoul stats from the specified timestamp.
     * @param int $timestamp The midnight timestamp.
     * @return array|null
     */
    public function getStatsFromTimestamp($timestamp)
    {
        // Calculating the midnight timestamp
        $midnight_timestamp = strtotime('today', $timestamp);
        if (array_key_exists($midnight_timestamp, $this->getStats()))
            return $this->_stats[$midnight_timestamp];
        return null;
    }

    /**
     * Obtains the netsoul stats form the specified DateTime
     * @param \DateTime $date The DateTime.
     * @return array|null
     */
    public function getStatsFromDateTime(\DateTime $date)
    {
        return $this->getStatsFromTimestamp($date->getTimestamp());
    }

    /**
     * Obtains the stats between the specified start and end timestamps.
     * @param int $start The start timestamp.
     * @param int $end The end timestamp
     * @return array
     */
    public function getStatsBetweenTimeStamp($start, $end)
    {
        // Calculating the midnight timestamps
        $midnight_start_timestamp = strtotime('today', $start);
        $midnight_end_timestamp = strtotime('today', $end);

        $stats = array();

        // Making the array
        foreach ($this->getStats() as $midnight_timestamp => $cur_stats)
            if ($midnight_timestamp >= $midnight_start_timestamp && $midnight_timestamp <= $midnight_end_timestamp)
                $stats[$midnight_timestamp] = $cur_stats;
            else if ($midnight_timestamp > $midnight_end_timestamp)
                break;

        return $stats;
    }

    /**
     * Obtains the stats between the specified start and end DateTime.
     * @param \DateTime $start The start DateTime.
     * @param \DateTime $end The end DateTime.
     * @return array
     */
    public function getStatsBetweenDateTime(\DateTime $start, \DateTime $end)
    {
        return $this->getStatsBetweenTimeStamp($start->getTimestamp(), $end->getTimestamp());
    }
} 