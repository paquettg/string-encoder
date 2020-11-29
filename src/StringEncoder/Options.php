<?php

declare(strict_types=1);

namespace StringEncoder;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\DTO\EncodingDTO;

class Options implements OptionsInterface
{
    /**
     * @var EncodingDTO
     */
    private $defaultTargetEncoding;

    /**
     * @var bool
     */
    private $removeUTF8BOM = false;

    /**
     * @var bool
     */
    private $caseSensitiveEncoding = true;

    /**
     * @throws Exceptions\InvalidEncodingException
     */
    public function setDefaultTargetEncoding(string $defaultTargetEncoding): OptionsInterface
    {
        $this->defaultTargetEncoding = EncodingDTO::makeFromString($defaultTargetEncoding, null, $this);

        return $this;
    }

    /**
     * @throws Exceptions\InvalidEncodingException
     */
    public function getDefaultTargetEncoding(): EncodingDTOInterface
    {
        if ($this->defaultTargetEncoding === null) {
            $this->defaultTargetEncoding = EncodingDTO::makeFromString('UTF-8');
        }

        return $this->defaultTargetEncoding;
    }

    public function setRemoveUTF8BOM(bool $remove): OptionsInterface
    {
        $this->removeUTF8BOM = $remove;

        return $this;
    }

    public function isRemoveUTF8BOM(): bool
    {
        return $this->removeUTF8BOM;
    }

    public function setCaseSensitiveEncoding(bool $caseSensitive): OptionsInterface
    {
        $this->caseSensitiveEncoding = $caseSensitive;

        return $this;
    }

    public function isCaseSensitiveEncoding(): bool
    {
        return $this->caseSensitiveEncoding;
    }
}
