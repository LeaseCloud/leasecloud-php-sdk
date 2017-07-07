<?php

namespace Montly;

use PHPUnit\Framework\TestCase;

/**
 * @covers Montly
 */
class OrderTest extends TestCase
{
    public function testCreateAnOrder ()
    {
        Montly::setApiKey('nisses_nyckel');

        $order = [
            "orderId" => "c8e0bda3",
            "firstName" => "Matthew",
            "lastName" => "Hunter",
            "company" => "Montly AB",
            "orgNumber" => "559089-4308",
            "email" => "hunter@example.com",
            "phone" => "09 61 64 48 49",
            "totalPrice" => 1000000,
            "VAT" => 250000,
            "shipping" => 0,
            "shippingVAT" => 0,
            "customerIp" => "131.168.20.70",
            "currency" => "SEK",
            "months" => 24,
            "tariff" => 3,
            "billingAddress" => "Rue 23",
            "billingCity" => "Chamonix",
            "billingPostcode" => "74400",
            "billingCountry" => "France",
            "monthlyPrice" => 231000
        ];

        $items = [[
            "name" => "Pixel",
            "productId" => "06ea2ff0b55c",
            "quantity" => 1,
            "totalPrice" => 750000,
            "VAT" => 187500
        ], [
            "name" => "Green boat",
            "productId" => "043ff0b55c",
            "quantity" => 1,
            "totalPrice" => 250000,
            "VAT" => 62500
        ]];

        $response = Order::create($order, $items);
        $this->assertEquals($response->id, 42);
    }
}
