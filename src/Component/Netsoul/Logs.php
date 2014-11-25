<?php
namespace EpitechAPI\Component\Netsoul;

use EpitechAPI\Connector;

class Logs
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The url to get data of user netsoul logs.
     */
    const NETSOUL_URL = 'https://intra.epitech.eu/user/{LOGIN}/netsoul/?format=json';

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
     * Contains the logs.
     *
     * @var array
     */
    protected $logs = array();

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this component taking the Connector to interact with Epitech's intranet.
     *
     * @param Connector $connector The connector signed in.
     * @param string $login The login of the user to load data.
     * @throws \Exception If the Connector is not signed in.
     */
    public function __construct(Connector $connector, $login = null)
    {
        // If the use is not signed in, we can't use this component.
        if (!$connector->isSignedIn())
            throw new \Exception("The Connector is not signed in");

        $this->connector = $connector;

        if ($login == null)
            $response = $this->connector->request(str_replace('{LOGIN}', $connector->getUser()->getLogin(), self::NETSOUL_URL));
        else
            $response = $this->connector->request(str_replace('{LOGIN}', $login, self::NETSOUL_URL));
        $data = $this->check($response);

        foreach ($data as $log_data) {
            $log = new Log($log_data);
            $this->logs[] = $log;
        }
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Adds the specified log.
     *
     * @param Log $log
     */
    public function addLog(Log $log)
    {
        $this->logs[$log->getTimestamp()] = $log;
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
        foreach ($this->logs as $log) {
            $log_datetime = $log->getDateTime();
            if ($log_datetime >= $from && $log_datetime <= $to)
                $logs[] = $log;
        }

        return $logs;
    }

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Checks the response and returns its json content as array
     *
     * @param array $response The connector response
     * @return array The json response
     * @throws \Exception If the response code is not 200 or if the json response is null
     */
    protected function check($response)
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
 