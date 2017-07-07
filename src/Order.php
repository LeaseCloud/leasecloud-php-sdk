<?php

namespace Montly;

class Order
{

    public static function create ($order, $items)
    {
        $http = HttpClient\CurlClient::instance();
        $headers = [
            'Authorization: Bearer '. Montly::getApiKey(),
            'Content-Type: application/json'
        ];

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

        return $http->request('post', Montly::$apiBase .'/v1/orders', $headers, $data)[0];
    }

}
