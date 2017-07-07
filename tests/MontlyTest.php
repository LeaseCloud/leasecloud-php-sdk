<?php

namespace Montly;

use PHPUnit\Framework\TestCase;

/**
 * @covers Montly
 */
class MontlyTest extends TestCase
{
    public function testSetAndGetApiKey()
    {
        Montly::setApiKey('Hello');
        $this->assertEquals('Hello', Montly::getApiKey());
    }
}
