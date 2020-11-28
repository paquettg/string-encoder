<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use StringEncoder\Encoder;

class EncoderTest extends TestCase
{
    private $encoder;

    public function setUp(): void
    {
        $this->encoder = new Encoder();
    }

    public function testSetSource()
    {
        $this->encoder->setSourceEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getSourceEncoding());
    }

    public function testSetTarget()
    {
        $this->encoder->setTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getTargetEncoding());
    }

    public function testConvert()
    {
        $this->encoder->setSourceEncoding('ISO-8859-1');
        $this->encoder->setTargetEncoding('UTF-8');
        $string = $this->encoder->convert()->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function testGetSourceWithoutSetting()
    {
        $this->assertNull($this->encoder->getSourceEncoding());
    }
}
