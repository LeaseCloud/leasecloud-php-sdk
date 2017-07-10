<?php

namespace Montly;

/**
 * Base class for Montly test cases, provides some utility methods for creating
 * objects.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    const API_KEY = 'dummyKey';

    private $mock;

    protected function setUp()
    {
        Montly::setApiKey(self::API_KEY);
        $this->mock = $this->setUpMockRequest();
        $this->call = 0;
    }

    protected function mockRequest($method, $path, $params = array(), $return = array('id' => 42), $rcode = 200, $base = 'https://api.montly.com')
    {
        $mock->expects($this->at($this->call++))
             ->method('request')
            //  ->with(strtolower($method), $base . $path, $this->anything(), $params, false)
             ->willReturn(array(json_decode(json_encode($return)), $rcode, array()));
    }

    private function setUpMockRequest()
    {
        if (!$this->mock) {
            $this->mock = $this->createMock('\Montly\HttpClient\ClientInterface');
            ApiRequestor::setHttpClient($this->mock);
        }
        return $this->mock;
    }
}
