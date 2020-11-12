<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Proxy\Encoder;

class EncoderTest extends TestCase
{
    public function setUp()
    {
        Encoder::mount('Encoder', new \StringEncoder\Encoder());
    }

    public function tearDown()
    {
        Encoder::unload();
    }

    public function testSetSource()
    {
        \Encoder::setSourceEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', \Encoder::getSourceEncoding());
    }

    public function testSetTarget()
    {
        \Encoder::setTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', \Encoder::getTargetEncoding());
    }
}
