<?php

namespace Montly;

class TariffTest extends MontlyTestCase
{

    public function testGetTariff()
    {
        $responseData = json_decode(json_encode([
          "tariffs" => [[
              "months" => 24,
              "tariff" => 4.47
          ], [
              "months" => 36,
              "tariff" => 3.04
          ]]
        ]));
        self::mockRequest('get', '/v1/tariffs', [], $responseData);

        $response = Tariff::retrieve();
        $this->assertEquals($response, $responseData);
    }

    public function testMonthlyCost()
    {
        $tariffs = json_decode(json_encode([
            "tariffs" => [[
                "months" => 24,
                "tariff" => 4.47
            ], [
                "months" => 36,
                "tariff" => 3.04
            ]]
        ]));


        static::assertEquals(358, Tariff::monthlyCost(7999, 24, $tariffs));
        static::assertEquals(243, Tariff::monthlyCost(7999, 36, $tariffs));
        static::assertNull(Tariff::monthlyCost(7999, 10, $tariffs));
    }
}
