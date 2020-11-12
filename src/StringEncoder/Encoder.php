<?php

declare(strict_types=1);

namespace StringEncoder;

use StringEncoder\Contracts\ConvertWriteInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\Convert;

class Encoder
{
    /**
     * @var EncodingDTO|null
     */
    private $sourceEncoding;

    /**
     * @var EncodingDTO|null
     */
    private $targetEncoding;

    public function getTargetEncoding(): ?string
    {
        return $this->targetEncoding->getEncoding();
    }

    /**
     * @throws InvalidEncodingException
     */
    public function setTargetEncoding(string $encoding): void
    {
        $this->targetEncoding = EncodingDTO::makeFromString($encoding);
    }

    public function getSourceEncoding(): ?string
    {
        return $this->sourceEncoding->getEncoding();
    }

    /**
     * @throws InvalidEncodingException
     */
    public function setSourceEncoding(string $encoding): void
    {
        $this->sourceEncoding = EncodingDTO::makeFromString($encoding);
    }

    public function convert(): ConvertWriteInterface
    {
        return new Convert($this->sourceEncoding, $this->targetEncoding);
    }
}
