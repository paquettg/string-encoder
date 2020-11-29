<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use StringEncoder\Encoder;
use StringEncoder\Options;

class EncoderOptionsTest extends TestCase
{
    private $encoder;

    public function setUp(): void
    {
        $this->encoder = new Encoder();
    }

    public function testSetSource()
    {
        $this->encoder->setOptions(
            (new Options())
                ->setCaseSensitiveEncoding(false)
        );
        $this->encoder->setSourceEncoding('iso-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getSourceEncoding());
    }

    public function testSetTarget()
    {
        $this->encoder->setOptions(
            (new Options())
                ->setCaseSensitiveEncoding(false)
        );
        $this->encoder->setTargetEncoding('iso-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getTargetEncoding());
    }
}
