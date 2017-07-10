<?php

namespace Montly;

class TariffTest extends TestCase
{

    public function testGetTariff ()
    {
        $responseData = json_decode(json_encode([
            "data" => [
                "type" => "tariffs",
                "attributes" => [
                    "tariffs" => [[
                        "months" => 24,
                        "tariff" => 4.47
                    ], [
                        "months" => 36,
                        "tariff" => 3.04
                    ]]
                ]
            ]
        ]));
        self::mockRequest('get', '/v1/tariffs', [], $responseData);

        $response = Tariff::retrieve();
        $this->assertEquals($response, $responseData);
    }
}
