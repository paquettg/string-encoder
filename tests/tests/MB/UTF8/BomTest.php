<?php

declare(strict_types=1);

namespace tests\MB\UTF8;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\MB\UTF8\Bom;
use StringEncoder\Options;

class BomTest extends TestCase
{
    /**
     * @var Bom
     */
    private $bom;

    public function setUp(): void
    {
        $this->bom = new Bom();
    }

    public function testRemoveBom()
    {
        $this->assertEquals(
            'this is a string',
            $this->bom->removeBOM(
                MBStringDTO::makeFromString("\xef\xbb\xbfthis is a string", new Options())
            )->getString()
        );
    }

    public function testRemoveBomFromEndOfString()
    {
        $this->assertEquals(
            'this is a string',
            $this->bom->removeBOM(
                MBStringDTO::makeFromString("this is a string\xef\xbb\xbf", new Options())
            )->getString()
        );
    }
}
