<?php

namespace Montly;

/**
 * Class ApiRequestor
 *
 * @package Montly
 */
class ApiRequestor
{
    private $apiKey;
    private $apiBase;
    private static $httpClient;

    /**
     * ApiRequestor constructor.
     *
     * @param null $apiKey
     * @param null $apiBase
     */
    public function __construct($apiKey = null, $apiBase = null)
    {
        $this->apiKey = $apiKey ? $apiKey : Montly::$apiKey;
        if (!$this->apiKey) {
            throw new Error('No API key is set');
        }

        if (!$apiBase) {
            $apiBase = Montly::$apiBase;
        }
        $this->apiBase = $apiBase;
    }

    /**
     * Return default headers
     *
     * @return array
     */
    private function defaultHeaders()
    {
        return [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ];
    }

    /**
     * Make an API request
     *
     * @param string $method
     * @param string $url
     * @param array|null $params
     * @param array|null $headers
     *
     * @return array An array whose first element is an API response and second
     *    element is the API key used to make the request.
     */
    public function request($method, $url, $params = null, $headers = [])
    {
        $headers = array_merge(self::defaultHeaders(), $headers);
        $absUrl = $this->apiBase . $url;
        return $this->httpClient()->request($method, $absUrl, $params, $headers);
    }

    /**
     * Externally set the http client instead of using the
     * default http client (Montly\HttpCluent\CurlClient)
     *
     * @param $client
     */
    public static function setHttpClient($client)
    {
        self::$httpClient = $client;
    }

    /**
     * If needed create, and return a http client
     *
     * @return HttpClient\CurlClient
     */
    private function httpClient()
    {
        if (!self::$httpClient) {
            self::$httpClient = HttpClient\CurlClient::instance();
        }
        return self::$httpClient;
    }
}
