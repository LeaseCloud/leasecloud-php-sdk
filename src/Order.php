<?php

namespace Montly;

class Order extends ApiResource
{

    public static function create ($order, $items)
    {
        $data = self::toJson($order, $items);
        return self::_create($data);
    }

    public static function toJson($order, $items) {
        $order['itemsCount'] = count($items);
        $order['items'] = $items;
        return $order;
    }

}
