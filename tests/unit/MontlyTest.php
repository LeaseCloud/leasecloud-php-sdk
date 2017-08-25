<?php
namespace Montly;

use PHPUnit\Framework\TestCase;

/**
 * @covers Montly\Montly
 */
class MontlyTest extends TestCase
{
    public function testSetAndGetApiKey()
    {
        Montly::setApiKey('Hello');
        $this->assertEquals('Hello', Montly::getApiKey());
    }

    public function testValidateSignature()
    {
        $timestamp = 9999999;
        $secret = 'SECRET';
        $payload = json_encode(['someValue' => 'theValue']);

        $hmacShaPayload = hash_hmac('sha256', $timestamp.$payload, $secret);
        $signature = "t=$timestamp,v1=$hmacShaPayload,v1=???";

        Montly::setWebHookSecret($secret);

        $valid = Montly::validateSignature($signature, $payload);
        static::assertTrue($valid);

        $valid = Montly::validateSignature('malformatted', $payload);
        static::assertFalse($valid);

        $signature = "t=$timestamp,v1=RANDOMNOISE,v1=???";
        $valid = Montly::validateSignature($signature, $payload);
        static::assertFalse($valid);
    }
}
