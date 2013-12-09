<?php
namespace EpitechAPI;

/**
 * Class Settings
 * @package Epitech\Libraries
 * @author Raphael DE FREITAS <raphythegeek@gmail.com>
 */
class Settings
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * The URL to submit the sign in form
     */
    const URL_SIGN_IN                   = 'https://intra.epitech.eu/';

    /**
     * The URL to get the user information
     */
    const URL_USER_PROFILE              = 'https://intra.epitech.eu/user/{LOGIN}/?format=json';

    /**
     * The URL to get the user netsoul stats
     */
    const URL_USER_NETSOUL_STATS        = 'https://intra.epitech.eu/user/{LOGIN}/netsoul/?format=json';

    /**
     * The cURL timeout
     */
    const CURL_TIMEOUT =                10;
} 