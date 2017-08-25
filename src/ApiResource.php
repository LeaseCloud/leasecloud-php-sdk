<?php

namespace Montly;

/**
 * Class ApiResource
 *
 * @package Montly
 */
abstract class ApiResource
{
    /**
     * Return the base url for the Montly API
     *
     * @return string
     *
     */
    public static function baseUrl()
    {
        return Montly::$apiBase;
    }

    /**
     * Return the name of the class, with namespacing and underscores
     * stripped.
     *
     * @return string The name
     *
     */
    public static function className()
    {
        $class = get_called_class();
        // Useful for namespaces: Foo\Charge
        if ($postfixNamespaces = strrchr($class, '\\')) {
            $class = substr($postfixNamespaces, 1);
        }
        // Useful for underscored 'namespaces': Foo_Charge
        if ($postfixFakeNamespaces = strrchr($class, '')) {
            $class = $postfixFakeNamespaces;
        }
        if (substr($class, 0, strlen('Montly')) == 'Montly') {
            $class = substr($class, strlen('Montly'));
        }
        $class = str_replace('_', '', $class);
        $name = urlencode($class);
        $name = strtolower($name);
        return $name;
    }

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        $base = static::className();
        return "/v1/${base}s";
    }

    /**
     * Make the http GET or POST request
     *
     * @param string $method
     * @param string $url
     * @param array|null $params
     *
     * @return array
     */
    protected static function staticRequest($method, $url, $params)
    {
        $requestor = new ApiRequestor();
        list($response) = $requestor->request($method, $url, $params);
        return array($response);
    }

    /**
     * Create (post) a resource via the remote API
     *
     * @param array|null $params
     *
     * @return mixed
     */
    protected static function create($params = null)
    {
        $url = static::classUrl();
        list($response) = static::staticRequest('post', $url, $params);
        return $response;
    }

    /**
     * Retrieve (get) data from the remote API
     *
     * @param null $id
     * @param array $params
     * @return mixed
     */
    protected static function retrieve($id = null, $params = [])
    {
        $url = static::classUrl();
        if ($id) {
            $url = $url . '/' . $id;
        }
        list($response) = static::staticRequest('get', $url, $params);
        return $response;
    }
}
