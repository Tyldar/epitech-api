<?php
namespace EpitechAPI\Components;
use EpitechAPI\Connector;
use EpitechAPI\Settings;

/**
 * Class Student represents a student.
 * @package EpitechAPI\Components
 * @author Raphael DE FREITAS <raphythegeek@gmail.com>
 */
class Student
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
     * Initializes a new instance of this class and retrieves the data of the specified student login.
     * @param Connector $connector The connector.
     * @param string $login The student login.
     * @throws \Exception If the connector is not signed in.
     */
    public function __construct(Connector $connector, $login)
    {
        // Checking the authentication
        if ($connector->getSignedIn() === false)
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
        $url = str_replace('{LOGIN}', $login, Settings::URL_USER_PROFILE);

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
     * Obtains the student data.
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

} 