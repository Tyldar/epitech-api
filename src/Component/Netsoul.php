<?php
namespace EpitechAPI\Component;

use EpitechAPI\Connector;
use EpitechAPI\Tool\DataExtractor;

class Netsoul
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    const URL_NETSOUL = 'https://intra.epitech.eu/user/{LOGIN}/netsoul/?format=json';

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
     * Contains the data.
     *
     * @var array
     */
    protected $data = array();

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
        // If the use is not signed in, we can't use this component.
        if (!$connector->isSignedIn())
            throw new \Exception("The Connector is not signed in");

        $this->connector = $connector;

        // Retrieving information about the specified user or signed in user
        if ($login == null)
            $response = $this->connector->request(str_replace('{LOGIN}', $this->connector->getUser()->getLogin(), self::URL_NETSOUL));
        else
            $response = $this->connector->request(str_replace('{LOGIN}', $login, self::URL_NETSOUL));
        $this->data = DataExtractor::retrieve($response);

        // Parsing the data
        $logs = array();
        foreach ($this->data as $log) {
            // Building the dates
            $datetime = null;
            if (($timestamp = DataExtractor::extract($log, array(0)))) {
                $datetime = new \DateTime();
                $datetime->setTimestamp($timestamp);
            }

            // Building the log
            $log = array(
                'timestamp' => $timestamp,
                'datetime' => $datetime,
                'time_active' => DataExtractor::extract($log, array(1)),
                'time_inactive' => DataExtractor::extract($log, array(2)),
                'timeout_active' => DataExtractor::extract($log, array(3)),
                'timeout_inactive' => DataExtractor::extract($log, array(4)),
                'time_average' => DataExtractor::extract($log, array(5)),
            );

            // Adding the log the temporary array
            $logs[$log['timestamp']] = $log;
        }

        // Replace the temporary array
        $this->data = $logs;
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the logs from the specified datetime to the specified datetime.
     * If $from is defined, it will return all logs from the specified datetime (the datetime is included >=)
     * If $to is defined, it will return all logs until the specified datetime (the datetime is included <=)
     *
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function getLogs(\DateTime $from = null, \DateTime $to = null)
    {
        $logs = array();

        // Building the range of searching
        if ($from == null) {
            $from = new \DateTime();
            $from->setTimestamp(0);
        }
        if ($to == null)
            $to = new \DateTime();

        // Making the search
        foreach ($this->data as $log) {
            $datetime = $log['datetime'];
            if ($datetime >= $from && $datetime <= $to)
                $logs[] = $log;
        }

        return $logs;
    }
}
 