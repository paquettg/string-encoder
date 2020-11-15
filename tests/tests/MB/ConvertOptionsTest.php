<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\MB\Convert;
use StringEncoder\Options;

class ConvertOptionsTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;
    /**
     * @var Options
     */
    private $options;

    public function setUp()
    {
        $this->options = new Options();
        $this->convert = new Convert(
            EncodingDTO::makeFromString('ISO-8859-1'),
            EncodingDTO::makeFromString('UTF-8'),
            $this->options->setRemoveUTF8BOM(true)
        );
    }

    public function testRemoveBom()
    {
        $string = $this->convert->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }
}
