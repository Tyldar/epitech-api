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

    /**
     * Contains the Netsoul stats.
     * @var StudentNetsoulStats
     */
    protected $_netsoul_stats;

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
        if ($connector->isSignedIn() === false)
            throw new \Exception('EpitechAPI: You must be authenticated');

        // Initializing the attributes
        $this->_connector = $connector;
        $this->_data = array();
        $this->_netsoul_stats = null;

        // Parsing the data
        $this->parse($login);
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the status of the student close account.
     * @return null|bool TRUE if the student is closed account else FALSE or NULL.
     */
    public function isCloseAccount()
    {
        if (array_key_exists('close', $this->_data))
            return $this->_data['close'];
        return null;
    }

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

    /**
     * Obtains the specified info from the student data.
     * @param string $name The info to retrieve.
     * @return null|mixed Teh value of the info.
     */
    public function getInfo($name)
    {
        if (array_key_exists($name, $this->_data))
            return $this->_data[$name];
        return null;
    }

    /**
     * Obtains the student login.
     * @return null|string  The student login or NULL.
     */
    public function getLogin()
    {
        return $this->getInfo('login');
    }

    /**
     * Obtains the student first name.
     * @return null|string The student first name or NULL.
     */
    public function getFirstName()
    {
        return $this->getInfo('firstname');
    }

    /**
     * Obtains the student last name.
     * @return null|string The student last name or NULL.
     */
    public function getLastName()
    {
        return $this->getInfo('lastname');
    }

    /**
     * Obtains the student location.
     * @return null|string The student location (ex: FR/LIL) or NULL.
     */
    public function getLocation()
    {
        return $this->getInfo('location');
    }

    /**
     * Obtains the student promotion.
     * @return null|int The student promotion or NULL.
     */
    public function getPromotion()
    {
        return $this->getInfo('promo');
    }

    /**
     * Obtains the student picture URL.
     * @return null|string The student picture URL or NULL.
     */
    public function getPictureUrl()
    {
        if (($login = $this->getLogin()) !== null)
            return 'https://cdn.local.epitech.eu/userprofil/profilview/'.$login.'.jpg';
        return null;
    }

    /**
     * Obtains the student miniature picture URL.
     * @return null|string The student miniature picture URL or NULL.
     */
    public function getMiniaturePictureUrl()
    {
        if (($login = $this->getLogin()) !== null)
            return 'https://cdn.local.epitech.eu/userprofil/commentview/'.$login.'.jpg';
        return null;
    }

    /**
     * Obtains the student GPA.
     * @return null|float The student GPA or NULL.
     */
    public function getGPA()
    {
        if (array_key_exists('gpa', $this->_data))
            return (float)$this->_data['gpa'][0]['gpa'];
        return null;
    }

    /**
     * Obtains the student year.
     * @return int|null The student year or NULL.
     */
    public function getYear()
    {
        return $this->getInfo('studentyear');
    }

    /**
     * Obtains the student semester.
     * @return int|null The student semester or NULL.
     */
    public function getSemester()
    {
        return $this->getInfo('semester');
    }

    /**
     * Obtains the student groups.
     * @return array
     */
    public function getGroups()
    {
        $groups_info = $this->getInfo('groups');
        $groups = array();
        foreach ($groups_info as $group)
            $groups[$group['name']] = $group['name'];
        return $groups;
    }

    /**
     * Obtains the Netsoul stats of this student.
     * @return StudentNetsoulStats The StudentNetsoulStats object.
     */
    public function getNetsoulStats()
    {
        if ($this->_netsoul_stats === null)
            $this->_netsoul_stats = new StudentNetsoulStats($this->_connector, $this->getLogin());
        return $this->_netsoul_stats;
    }
} 