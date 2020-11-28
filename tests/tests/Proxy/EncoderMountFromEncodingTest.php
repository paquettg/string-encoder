<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Proxy\Encoder;

class EncoderMountFromEncodingTest extends TestCase
{
    public function setUp(): void
    {
        Encoder::mountFromEncoding('ISO-8859-1', 'UTF-8');
    }

    public function tearDown(): void
    {
        Encoder::unload();
    }

    public function testConvert()
    {
        $string = Encoder::convert()->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function testGetMountedEncoder()
    {
        $encoder = Encoder::getMountedEncoder();
        $this->assertTrue($encoder instanceof \StringEncoder\Encoder);
    }
}
