<?php
namespace LeaseCloud;

/**
 * @covers LeaseCloud\LeaseCloud
 */
class LeaseCloudTest extends LeaseCloudTestCase
{
    public function testSetAndGetApiKey()
    {
        LeaseCloud::setApiKey('Hello');
        $this->assertEquals('Hello', LeaseCloud::getApiKey());
    }
}
