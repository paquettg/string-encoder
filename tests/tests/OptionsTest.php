<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use StringEncoder\Encoder;
use StringEncoder\Options;

class OptionsTest extends TestCase
{
    private $encoder;
    /**
     * @var Options
     */
    private $options;

    public function setUp(): void
    {
        $this->encoder = new Encoder();
        $this->options = new Options();
    }

    public function testSetOptions()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function testSetOptionsInEncoder()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->encoder->setOptions($this->options);
        $this->assertNull($this->encoder->getTargetEncoding());
    }

    public function testSetDefaultTargetEncoding()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function testSetDefaultTargetOptionsEncoding()
    {
        $this->options->setCaseSensitiveEncoding(false);
        $this->options->setDefaultTargetEncoding('iso-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function testSetRemoveUTF8BOM()
    {
        $this->options->setRemoveUTF8BOM(true);
        $this->assertTrue($this->options->isRemoveUTF8BOM());
    }

    public function testSetCaseSensitiveEncoding()
    {
        $this->options->setCaseSensitiveEncoding(false);
        $this->assertFalse($this->options->isCaseSensitiveEncoding());
    }

}
