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
     * The webhook secret for validating incomming webhook calls
     *
     * @var string
     */
    private static $webHookSecret = '';

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

    /**
     * Sets the webhook secret
     *
     * @param string $secret
     */
    public static function setWebHookSecret($secret)
    {
        self::$webHookSecret = $secret;
    }

    /**
     * Validate the webhook signature
     *
     * @param string $signature The string passed in header Montly-Signature
     * @param string $payload   The raw payload
     *
     * @return bool True if the signature is valid, otherwise false
     */
    public static function validateSignature($signature, $payload)
    {
        $parts = explode(',', $signature);
        $parameters = [];
        foreach ($parts as $part) {
            parse_str($part, $parsed);
            $key = key($parsed);
            $value = $parsed[$key];
            if (!isset($parameters[$key])) {
                $parameters[$key] = $value;
            }
        }

        // We need timetamp and payload sig
        if (!(isset($parameters['t']) && isset($parameters['v1']))) {
            return false;
        }

        $wanted = hash_hmac('sha256', $parameters['t'] . $payload, self::$webHookSecret);

        return $wanted === $parameters['v1'];
    }
}
