<?php

namespace Montly;

class Order extends ApiResource
{

    public static function create ($order)
    {
        return self::_create($order);
    }

}
