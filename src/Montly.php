<?php
namespace Montly;

/**
 * Class Montly
 *
 * @package Montly
 */
class Montly
{
    /**
     * The Montly API key to be used for requests.
     *
     * @var string
     */
    public static $apiKey;

    /**
     * The base URL for the Montly API.
     *
     * @var string
     */
    public static $apiBase = 'https://api.montly.com';

    /**
     * Gets the API key to be used for requests.
     *
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }


}
