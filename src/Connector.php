<?php
namespace EpitechAPI;

use EpitechAPI\Component\User;

/**
 * Class Connector is the main class of the API. It allows request from intranet and authenticate an user.
 */
class Connector
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The sign in url.
     */
    const SIGN_IN_URL = 'https://intra.epitech.eu/?format=json';

    /**
     * Sign in using a login and a password.
     */
    const SIGN_IN_METHOD_CREDENTIALS = 0;

    /**
     * Sing in using the intranet session id (PHPSESSID).
     */
    const SIGN_IN_METHOD_PHPSESSID = 1;

    /**
     * Sing in using the intranet autologin link.
     */
    const SIGN_IN_METHOD_AUTOLOGIN_LINK = 2;

    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains whether the student is signed in.
     *
     * @var bool
     */
    protected $isSignedIn = false;

    /**
     * Contains the PHPSESSID cookie is setted
     *
     * @var string
     */
    protected $PHPSESSID = null;

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes the connector.
     */
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Makes a cURL request to the specified intranet URL and obtains the response content.
     *
     * @param string $url The URL where to make the request
     * @param array $options The cURL options. See the PHP cURL curl_setopt() function documentation for more information.
     *
     * @return array|bool Returns an array containing the response information or FALSE on failure.
     */
    public function request($url, $options = array())
    {
        // Initializing cURL
        $ch = curl_init($url);

        // Setting the default options
        curl_setopt_array($ch, array(
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
        ));

        // If the URL is using SSL we don't need to verify the certificate
        if (preg_match('`^https://`i', $url) > 0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }

        // If we already have authenticated and have the PHPSESSID reuse it (it avoids to re authenticate before each request)
        if ($this->PHPSESSID != null && !in_array(CURLOPT_COOKIE, $options))
            curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=' . $this->PHPSESSID);

        // Setting the specific options
        curl_setopt_array($ch, $options);

        curl_setopt($ch, CURLOPT_HEADER, 1);

        // Executing the cURL request
        $curl_response = curl_exec($ch);
        if ($curl_response === false)
            return (false);

        // Here whe have to get the PHPSESSID cookie
        list($header, $content) = explode("\r\n\r\n", $curl_response, 2);
        if ($this->PHPSESSID == null) {
            $phpsessid = str_replace("\r\n", " ", $header);
            $this->PHPSESSID = preg_replace("/.*PHPSESSID=([^;]*);.*/", "\\1", $phpsessid);
        }

        // Building the response
        $response = array(
            'code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
            'raw' => $content
        );
        $content = str_replace("// Epitech JSON webservice ...\n", "", $content);
        $response['json'] = json_decode($content, true);

        /*
         * The response array is formatted by the following :
         * array (
         *     'code' => integer (HTTP response code)
         *     'raw' => string (HTTP response raw content)
         *     'json' => array (the raw content parsed to JSON, /!\ CAN BE NULL IF JSON_DECODE() FAILED /!\)
         * )
         */

        // Closing cURL
        curl_close($ch);

        return $response;
    }

    /**
     * Sign in the student to the intranet.
     *
     * @param int $method the authentication method
     * @throws \InvalidArgumentException
     */
    public function authenticate($method)
    {
        // If the student is already signed in, do nothing
        if ($this->isSignedIn())
            return;

        // Getting the function paremeters
        $parameters = func_get_args();

        switch ($method) {
            /**
             * Using the student login and unix password
             */
            case self::SIGN_IN_METHOD_CREDENTIALS:

                // We expect the login and unix password parameters
                if (count($parameters) != 3)
                    throw new \InvalidArgumentException();

                $login = $parameters[1];
                $password = $parameters[2];

                $sign_in_form = array(
                    'login' => $login,
                    'password' => $password,
                    'remind' => true
                );

                $response = $this->request(self::SIGN_IN_URL, array(
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIESESSION => true,
                    CURLOPT_POSTFIELDS => http_build_query($sign_in_form)
                ));

                // The authentication is done if the response code is 200 Ok
                $this->isSignedIn = $response['code'] == 200;

                break;

            /**
             * Using the student session id (the PHPSESSID cookie)
             */
            case self::SIGN_IN_METHOD_PHPSESSID:

                // We expect an array
                if (count($parameters) != 2)
                    throw new \InvalidArgumentException();

                $phpsessid = $parameters[1];

                $response = $this->request(self::SIGN_IN_URL, array(
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIESESSION => true,
                    CURLOPT_COOKIE => 'PHPSESSID=' . $phpsessid
                ));
                $this->PHPSESSID = $phpsessid;

                // The authentication is done if the response code is 200 Ok
                $this->isSignedIn = $response['code'] == 200;

                break;

            /**
             * Using the student autologin link
             */
            case self::SIGN_IN_METHOD_AUTOLOGIN_LINK:

                // We expect a link
                if (count($parameters) != 2)
                    throw new \InvalidArgumentException();

                $link = $parameters[1];

                $response = $this->request($link, array(
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIESESSION => true
                ));

                // The authentication is done if the response code is 302 Redirection
                $this->isSignedIn = $response['code'] == 302;

                break;
            default:
                throw new \InvalidArgumentException();
        }
    }

    /**
     * Obtains whether the student is signed in.
     *
     * @return bool
     */
    public function isSignedIn()
    {
        return $this->isSignedIn;
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the PHPSESSID cookie
     *
     * @return string
     */
    public function getPHPSESSID()
    {
        return $this->PHPSESSID;
    }

    /**
     * Obtains the signed in User component.
     *
     * @return User
     */
    public function getUser()
    {
        return new User($this);
    }

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

}