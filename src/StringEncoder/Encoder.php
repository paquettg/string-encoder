<?php

declare(strict_types=1);

namespace StringEncoder;

use StringEncoder\Contracts\ConvertReadInterface;
use StringEncoder\Contracts\EncoderInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\Convert;

final class Encoder implements EncoderInterface
{
    /**
     * @var EncodingDTO|null
     */
    private $sourceEncoding;

    /**
     * @var EncodingDTO|null
     */
    private $targetEncoding;

    /**
     * @var OptionsInterface|null
     */
    private $options;

    public function setOptions(OptionsInterface $options): EncoderInterface
    {
        $this->options = $options;

        return $this;
    }

    public function getTargetEncoding(): ?string
    {
        if ($this->targetEncoding === null) {
            return null;
        }

        return $this->targetEncoding->getEncoding();
    }

    /**
     * @throws InvalidEncodingException
     */
    public function setTargetEncoding(string $encoding): void
    {
        $this->targetEncoding = EncodingDTO::makeFromString($encoding, null, $this->options);
    }

    public function getSourceEncoding(): ?string
    {
        if ($this->sourceEncoding === null) {
            return null;
        }

        return $this->sourceEncoding->getEncoding();
    }

    /**
     * @throws InvalidEncodingException
     */
    public function setSourceEncoding(string $encoding): void
    {
        $this->sourceEncoding = EncodingDTO::makeFromString($encoding, null, $this->options);
    }

    public function convert(): ConvertReadInterface
    {
        return new Convert($this->sourceEncoding, $this->targetEncoding, $this->options);
    }
}
