<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;

interface OptionsInterface
{
    public function setDefaultTargetEncoding(string $defaultTargetEncoding): OptionsInterface;

    public function getDefaultTargetEncoding(): EncodingDTOInterface;

    public function setRemoveUTF8BOM(bool $remove): OptionsInterface;

    public function isRemoveUTF8BOM(): bool;

    public function setCaseSensitiveEncoding(bool $caseSensitive): OptionsInterface;

    public function isCaseSensitiveEncoding(): bool;
}
