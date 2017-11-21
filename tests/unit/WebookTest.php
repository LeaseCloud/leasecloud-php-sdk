<?php
namespace LeaseCloud;

/**
 * @covers LeaseCloud\Webook
 */
class WebookTest extends LeaseCloudTestCase
{
    public function testValidateSignature()
    {
        $timestamp = 9999999;
        $secret = 'SECRET';
        $payload = json_encode(['someValue' => 'theValue']);

        $hmacShaPayload = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);
        $signature = "t=$timestamp,v1=$hmacShaPayload,v1=???";

        Webook::setSecret($secret);

        $valid = Webook::validateSignature($signature, $payload);
        static::assertTrue($valid);

        $valid = Webook::validateSignature('malformatted', $payload);
        static::assertFalse($valid);

        $signature = "t=$timestamp,v1=RANDOMNOISE,v1=???";
        $valid = Webook::validateSignature($signature, $payload);
        static::assertFalse($valid);

        $signature = "t=$timestamp,v1=???,v1=$hmacShaPayload";
        $valid = Webook::validateSignature($signature, $payload);
        static::assertTrue($valid);
    }
}
