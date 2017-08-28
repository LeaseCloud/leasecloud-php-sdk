<?php
namespace Montly;

/**
 * Class Webook
 * @package Montly
 */
class Webook
{
    /**
     * The webhook secret for validating incomming webhook calls
     *
     * @var string
     */
    private static $secret = '';

    /**
     * Sets the webhook secret
     *
     * @param string $secret
     */
    public static function setSecret($secret)
    {
        self::$secret = $secret;
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
        $t = 0;
        // Find the timestamp
        foreach ($parts as $part) {
            parse_str($part, $parsed);
            if (key($parsed) === 't') {
                $t = $parsed['t'];
                break;
            }
        }

        if ($t === 0) {
            return false;
        }

        $wanted = hash_hmac('sha256', $t . $payload, self::$secret);

        // Find v1 hashes
        foreach ($parts as $part) {
            parse_str($part, $parsed);
            if (key($parsed) === 'v1') {
                if ($wanted === $parsed['v1']) {
                    return true;
                }
            }
        }

        return false;
    }
}