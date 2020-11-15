<?php

declare(strict_types=1);

namespace StringEncoder\Contracts\MB;

use StringEncoder\Contracts\DTO\MBStringDTOInterface;

interface RegexInterface
{
    public function setEncoding(string $encoding): void;

    public function getEncoding(): string;

    public function replace(
        string $pattern,
        string $replace,
        MBStringDTOInterface $MBStringDTO,
        bool $ignoreCase = false
    ): MBStringDTOInterface;

    /**
     * @param string[] $patterns
     * @param string[] $replaces
     */
    public function replaceMultiple(
        array $patterns,
        array $replaces,
        MBStringDTOInterface $MBStringDTO,
        bool $ignoreCase = false
    ): MBStringDTOInterface;
}
