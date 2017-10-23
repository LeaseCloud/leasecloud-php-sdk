<?php

namespace LeaseCloud;

/**
 * @covers LeaseCloud\Order
 */
class OrderTest extends LeaseCloudTestCase
{
    public function testCreateAnOrder()
    {
        $order = [
            "orderId" => "c8e0bda3",
            "firstName" => "Matthew",
            "lastName" => "Hunter",
            "company" => "LeaseCloud AB",
            "orgNumber" => "559089-4308",
            "email" => "hunter@example.com",
            "phone" => "09 61 64 48 49",
            "totalAmount" => 1000000,
            "VAT" => 250000,
            "shippingAmount" => 0,
            "shippingVAT" => 0,
            "customerIp" => "131.168.20.70",
            "currency" => "SEK",
            "months" => 24,
            "tariff" => 3,
            "billing" => [
              "address" => "Rue 23",
              "city" => "Chamonix",
              "postalCode" => "74400",
              "country" => "SE"
            ],
            "monthlyAmount" => 231000,
            "items" => [[
                "name" => "Pixel",
                "productId" => "06ea2ff0b55c",
                "quantity" => 1,
                "totalAmount" => 750000,
                "unitAmount" => 750000,
                "VAT" => 187500
            ], [
                "name" => "Green boat",
                "productId" => "043ff0b55c",
                "quantity" => 1,
                "totalAmount" => 250000,
                "unitAmount" => 250000,
                "VAT" => 62500
            ]]
        ];

        self::mockRequest('post', '/v1/orders', $order, ['orderId' => 'c8e0bda3']);

        $response = Order::create($order);
        $this->assertEquals($response->orderId, 'c8e0bda3');
    }
}
