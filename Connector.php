<?php
namespace EpitechAPI;

/**
 * Class Connector manages the connection from the intranet.
 * It initializes the connection and makes the requests for the components
 *
 * @package EpitechAPI
 * @author Raphael DE FREITAS <raphythegeek@gmail.com>
 * @author Antoine KNOCKAERT
 */
class Connector
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the login
     * @var string
     */
    protected $_login;

    /**
     * Contains the password
     * @var string
     */
    protected $_password;

    /**
     * Contains the status of the authentication
     * @var bool
     */
    protected $_is_signed_in;

    /**
     * Contains the cookies file name
     * @var string
     */
    protected $_cookies_file;

    # # # # # # # # # # # # # # # # # # # #
    #             Magic Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes a new instance of this class and authenticates from the intranet with the specified login and password.
     * @param string $login The login for the authetication.
     * @param string $password The associated Unix password.
     */
    public function __construct($login, $password)
    {
        // Initializing the attributes
        $this->_login = $login;
        $this->_password = $password;
        $this->_is_signed_in = false;
        $this->_cookies_file = '/tmp/EpitechAPI_'.uniqid();

        // Signing in
        $this->sign_in();
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Makes a cURL request to the specified intranet URL and obtains the response content.
     * @param string $url The URL where to make the request
     * @param array $options The cURL options. See the PHP cURL curl_setopt() function documentation for more information.
     * @return string|bool Returns a string of the response content else FALSE on error.
     */
    public function request($url, $options = array())
    {
        // Making the cURL request
        $ch = curl_init($url);

        // Setting the global options
        curl_setopt_array($ch, array(
            CURLOPT_TIMEOUT => Settings::CURL_TIMEOUT,
            CURLOPT_CONNECTTIMEOUT => Settings::CURL_TIMEOUT,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_COOKIEJAR => $this->_cookies_file,
            CURLOPT_COOKIEFILE => $this->_cookies_file
        ));

        // Setting the specific options
        if (preg_match('`^https://`i', $url)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }

        // Setting the parameter options
        curl_setopt_array($ch, $options);

        // Executing the cURL request
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    /**
     * Obtains the authentication status.
     * @return bool Returns TRUE if authenticated else FALSE.
     */
    public function isSignedIn()
    {
        return $this->_is_signed_in;
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Protected Methods          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Authenticates from the intranet.
     */
    protected function sign_in()
    {
        // Setting the form data
        $post_data = array(
            'login' => $this->_login,
            'password' => $this->_password,
            'remind' => true
        );

        $authentication = $this->request(Settings::URL_SIGN_IN, array(
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_POSTFIELDS => http_build_query($post_data)
        ));

        // Checking the authentication
        if ($authentication === false)
            $this->_is_signed_in = false;
        else
            $this->_is_signed_in = true;
    }
} 