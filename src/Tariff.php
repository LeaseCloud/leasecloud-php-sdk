<?php
namespace Montly;

/**
 * Class Tariff
 * @package Montly
 */
class Tariff extends ApiResource
{
    /**
     * Retreive (get) Montly tariffs
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
