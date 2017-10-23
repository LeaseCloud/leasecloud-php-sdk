<?php
namespace LeaseCloud;

/**
 * Class LeaseCloud
 *
 * @package LeaseCloud
 */
class LeaseCloud
{
    /**
     * The LeaseCloud API key to be used for requests.
     *
     * @var string
     */
    public static $apiKey;

    /**
     * The base URL for the LeaseCloud API.
     *
     * @var string
     */
    public static $apiBase = 'https://api.leasecloud.com';

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
