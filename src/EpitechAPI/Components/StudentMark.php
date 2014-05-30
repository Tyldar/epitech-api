<?php

namespace EpitechAPI\Components;

use EpitechAPI\Connector;
use EpitechAPI\Settings;

/*
 * Class StudentMark provides information about the student's marks
 * @package EpitechAPI\Components
 * @author Thibault de BALTHASAR <public_github@thibaultdebalt.fr>
 */

class StudentMark {

    protected $_connector;
    protected $_data;

    public function __construct(Connector $connector, $login) {
        // Checking the authentication
        if ($connector->isSignedIn() === false)
            throw new \Exception('EpitechAPI: You must be authenticated');

        // Initializing the attributes
        $this->_connector = $connector;
        $this->_data = array();

        // Parsing the data
        $this->parse($login);
    }

    public function isCloseAccount() {
        if (array_key_exists('close', $this->_data))
            return $this->_data['close'];
        return null;
    }

    protected function parse($login) {
        // Parsing the URL
        $url = str_replace('{LOGIN}', $login, Settings::URL_USER_MARKS);

        // Parsing the request content
        $json_content = $this->_connector->request($url);
        $json_content = str_replace("// Epitech JSON webservice ...\n", "", $json_content);

        // Setting the user data
        if (($this->_data = json_decode($json_content, true)) === null)
            throw new \Exception('EpitechAPI::User: The JSON content is not valid: ' . json_last_error_msg());
    }

    public function getConnector() {
        return ($this->_connector);
    }

    public function getData() {
        return $this->_data;
    }

    public function getModules() {
        return $this->_data['modules'];
    }

    public function getMarks() {
        return $this->_data['notes'];
    }

    /*
     * return an array of marks for the given module
     */

    public function getModuleMarks($codeModule) {
        foreach ($this->_data['notes'] as $note) {
            if ($note['codemodule'] == $codeModule)
                $res[] = $note;
        }
        return ($res);
    }

    /*
     * return the average for the module
     */

    public function getModuleAverage($codeModule, $precision = 2) {
        $nbMarks = 0;
        $total = 0;
        foreach ($this->_data['notes'] as $note) {
            if ($note['codemodule'] == $codeModule) {
                $nbMarks += 1;
                $total += (int) $note['final_note'];
            }
        }
        return (number_format($total / $nbMarks, $precision));
    }

}
