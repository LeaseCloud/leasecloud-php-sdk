<?php
namespace Montly;

/**
 * @covers Montly\Montly
 */
class MontlyTest extends MontlyTestCase
{
    public function testSetAndGetApiKey()
    {
        Montly::setApiKey('Hello');
        $this->assertEquals('Hello', Montly::getApiKey());
    }
}
