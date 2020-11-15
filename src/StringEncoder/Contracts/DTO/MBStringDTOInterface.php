<?php

declare(strict_types=1);

namespace StringEncoder\Contracts\DTO;

use StringEncoder\Contracts\OptionsInterface;

interface MBStringDTOInterface
{
    public function getString(): string;

    public function getEncodingDTO(): EncodingDTOInterface;

    public function getOptions(): OptionsInterface;
}
