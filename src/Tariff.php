<?php
namespace LeaseCloud;

/**
 * Class Tariff
 * @package LeaseCloud
 */
class Tariff extends ApiResource
{
    /**
     * Retreive (get) LeaseCloud tariffs
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

    /**
     * Return the monthly cost for an item at $price leased for $months
     * given the $tariffs in use for the LeaseCloud account
     *
     * @param double  $price   The price of the object
     * @param integer $months  The agreement length
     * @param object  $tariffs The tariffs object, as returned by Tariff:retrieve
     *
     * @return integer|null The monthly cost for the end user
     */
    public static function monthlyCost($price, $months, $tariffs)
    {

        $tariff = static::tariff($months, $tariffs);
        if (!is_null($tariff)) {
            return round($price * ($tariff / 100));
        }

        // If we're still here, it means that we don't have any tariff
        // matching the number of months specified. Return null.
        return null;
    }

    /**
     * Return the $tariff for a contract at $months length
     * given the tarrifs in use for the LeaseCloud account
     *
     * @param $months
     * @param $tariffs
     *
     * @return double|null The tariff, or null if no tariff was found
     */
    public static function tariff($months, $tariffs)
    {
        foreach ($tariffs->tariffs as $tariff) {
            if ($months == $tariff->months) {
                return (double)($tariff->tariff);
            }
        }

        return null;
    }
}
