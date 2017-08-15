<?php
namespace Montly;
/**
 * Class ApiRequestor
 *
 * @package Montly
 */
class ApiRequestor
{
    private $_apiKey;
    private $_apiBase;
    private static $_httpClient;

    public function __construct($apiKey = null, $apiBase = null)
    {
        $this->_apiKey = $apiKey ? $apiKey : Montly::$apiKey;
        if (!$this->_apiKey) throw new Error('No API key is set');

        if (!$apiBase) $apiBase = Montly::$apiBase;
        $this->_apiBase = $apiBase;
    }

    function defaultHeaders()
    {
        return [
            'Authorization: Bearer '. $this->_apiKey,
            'Content-Type: application/json'
        ];
    }

    /**
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
        $absUrl = $this->_apiBase . $url;
        return $this->httpClient()->request($method, $absUrl, $params, $headers);
    }

    public static function setHttpClient($client)
    {
        self::$_httpClient = $client;
    }

    private function httpClient()
    {
        if (!self::$_httpClient) {
            self::$_httpClient = HttpClient\CurlClient::instance();
        }
        return self::$_httpClient;
    }
}
