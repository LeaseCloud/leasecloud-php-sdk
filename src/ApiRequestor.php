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

    function defaultHeaders()
    {
        return [
            'Authorization: Bearer '. Montly::getApiKey(),
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
        $absUrl = Montly::$apiBase . $url;
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
