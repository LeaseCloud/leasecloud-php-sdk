<?php
namespace LeaseCloud;

/**
 * Class Config
 * @package LeaseCloud
 */
class Config extends ApiResource
{
    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        return "/v1/Config";
    }

    /**
     * Retreive (get) LeaseCloud config
     *
     * @param null $id
     * @param array $params
     *
     * @return mixed
     */
    public static function retrieve($id = null, $params = [])
    {
        return parent::retrieve($id, $params);
    }
}
