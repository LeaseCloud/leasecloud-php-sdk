<?php

namespace Montly;

class Order extends ApiResource
{

    public static function create ($order, $items)
    {
        $data = self::toJsonApi($order, $items);
        return self::_create($data);
    }

    public static function toJsonApi($order, $items) {
        $order['itemsCount'] = count($items);
        $data = [
            'data' => [
                'type' => 'order',
                'attributes' => $order,
                'relationships' => [
                    'item' => [
                        'data' => $items
                    ]
                ]
            ]
        ];

        return $data;
    }

}
