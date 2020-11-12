<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\ConvertReadInterface;
use StringEncoder\Contracts\ConvertWriteInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\ConvertNoValueException;

class Convert implements ConvertReadInterface, ConvertWriteInterface
{
    /**
     * @var EncodingDTO
     */
    private $sourceEncoding;
    /**
     * @var ?EncodingDTO
     */
    private $targetEncoding;
    /**
     * @var ?string
     */
    private $value;

    public function __construct(?EncodingDTO $sourceEncoding = null, ?EncodingDTO $targetEncoding = null)
    {
        if ($targetEncoding === null) {
            // default target encoding is UTF-8
            $targetEncoding = EncodingDTO::makeFromString('UTF-8');
        }
        $this->sourceEncoding = $sourceEncoding;
        $this->targetEncoding = $targetEncoding;
    }

    public function fromString(string $value): ConvertReadInterface
    {
        $this->convert($value);

        return $this;
    }

    /**
     * @throws ConvertNoValueException
     */
    public function toString(): string
    {
        if ($this->value === null) {
            throw new ConvertNoValueException('No value set for call to convert to string.');
        }

        return $this->value;
    }

    private function convert(string $value): void
    {
        if ($this->sourceEncoding === null) {
            $this->value = \mb_convert_encoding($value, $this->targetEncoding->getEncoding());
        } elseif ($this->sourceEncoding->getEncoding() !== $this->targetEncoding->getEncoding()) {
            $this->value = \mb_convert_encoding($value, $this->targetEncoding->getEncoding(), $this->sourceEncoding->getEncoding());
        }
    }
}
