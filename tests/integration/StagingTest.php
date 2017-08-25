<?php
namespace Montly;

/**
 * Base class for Montly test cases, provides some utility methods for creating
 * objects.
 */
class StagingTest extends \PHPUnit_Framework_TestCase
{

    const API_KEY = 'EriksApiKey';
    const API_URL = 'https://api.staging.montly.com';

    /**
     * @group createorder
     */
    public function testCreateOrderSuccessful()
    {

        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $order = $this->dummyOrder();
        $orderId = $order['orderId'];
        $response = Order::create($order);
        print_r($response);
        static::assertEquals($orderId, $response->orderId);
        static::assertEquals(50000, $response->monthlyAmount);

        return $order;
    }

    /**
     * @depends testCreateOrderSuccessful
     */
    public function testCreateOrderFailDuplicate($order)
    {
        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $response = Order::create($order);

        static::assertTrue(isset($response->errors));
        static::assertEquals(1, count($response->errors));
        static::assertEquals('Validation error', $response->errors[0]->title);
    }

    public function testCreateOrderFailFieldsMissing()
    {
        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $order = $this->dummyOrder();
        unset($order['orderId']);
        $response = Order::create($order);

        static::assertTrue(isset($response->errors));
        static::assertEquals(1, count($response->errors));
        static::assertEquals('notNull Violation', $response->errors[0]->title);
        static::assertTrue(stripos($response->errors[0]->detail, 'orderId') !== false);

        $order = $this->dummyOrder();
        unset($order['orgNumber']);
        $response = Order::create($order);

        static::assertTrue(isset($response->errors));
        static::assertEquals(1, count($response->errors));
        static::assertEquals('notNull Violation', $response->errors[0]->title);
        static::assertTrue(stripos($response->errors[0]->detail, 'orgNumber') !== false);
    }

    /**
     * @depends testCreateOrderSuccessful
     */
    public function testGetOrderStatus($order)
    {
        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $orderId = $order['orderId'];
        $response = Order::status($orderId);

        static::assertEquals($orderId, $response->orderId);
        static::assertEquals('pending', $response->status);
    }

    /**
     * @depends testCreateOrderSuccessful
     */
    public function testCancel($order)
    {
        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $orderId = $order['orderId'];
        $response = Order::cancel($orderId);

        static::assertNull($response);
    }

    public function testGetOrderStatusForNonexistingOrder()
    {
        Montly::$apiBase = self::API_URL;
        Montly::setApiKey(self::API_KEY);

        $orderId = md5(microtime(true));
        $response = Order::status($orderId);

        static::assertTrue(isset($response->errors));
        static::assertEquals(1, count($response->errors));
    }

    public function testNonexistingURL()
    {
        Montly::$apiBase = 'https://does.not.exist.com';
        Montly::setApiKey(self::API_KEY);

        $orderId = md5(microtime(true));
        try {
            $response = Order::status($orderId);
        } catch (Error $e) {
            static::assertContains('Montly', (string)$e);
            static::assertContains('Could not resolve host', (string)$e);
            static::assertContains('Could not connect', $e->getMessage());
        }
    }

    private function dummyOrder()
    {
        $orderId = md5(microtime(true));
        return [
            "orderId" => $orderId,
            "firstName" => "Matthew",
            "lastName" => "Hunter",
            "company" => "Montly AB",
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
            "tariff" => 5,
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
    }
}