<?php

namespace Montly;

/**
 * Class ApiResource
 *
 * @package Montly
 */
abstract class ApiResource
{
    private static $HEADERS_TO_PERSIST = array('Stripe-Account' => true, 'Stripe-Version' => true);

    public static function baseUrl()
    {
        return Montly::$apiBase;
    }

    /**
     * @return string The name of the class, with namespacing and underscores
     *    stripped.
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

    protected static function _staticRequest($method, $url, $params)
    {
        $requestor = new ApiRequestor();
        list($response) = $requestor->request($method, $url, $params);
        return array($response);
    }

    protected static function _create($params = null, $options = null)
    {
        $url = static::classUrl();
        list($response) = static::_staticRequest('post', $url, $params);
        return $response;
    }
}
