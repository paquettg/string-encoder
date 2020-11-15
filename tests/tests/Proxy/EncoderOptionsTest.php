<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Options;
use StringEncoder\Proxy\Encoder;

class EncoderOptionsTest extends TestCase
{
    /**
     * @var Options
     */
    private $options;

    public function setUp()
    {
        $this->options = new Options();
        Encoder::mount('Encoder', new \StringEncoder\Encoder());
    }

    public function tearDown()
    {
        Encoder::unload();
    }

    public function testSetOptions()
    {
        \Encoder::setOptions($this->options);
        $this->assertNull(\Encoder::getTargetEncoding());
    }
}
