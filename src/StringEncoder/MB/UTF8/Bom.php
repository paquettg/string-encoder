<?php

declare(strict_types=1);

namespace StringEncoder\MB\UTF8;

use StringEncoder\Contracts\DTO\MBStringDTOInterface;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\Exceptions\InvalidEncodingException;

class Bom
{
    /**
     * @throws InvalidEncodingException
     *
     * @internal
     */
    public function removeBOM(MBStringDTOInterface $MBStringDTO): MBStringDTOInterface
    {
        $value = $MBStringDTO->getString();
        // remove utf-8 BOM
        if (\substr($value, 0, 3) == "\xef\xbb\xbf") {
            $value = \substr($value, 3);
        }
        if (\substr($value, -3, 3) == "\xef\xbb\xbf") {
            $value = \substr($value, 0, -3);
        }

        return MBStringDTO::makeFromDTO($value, $MBStringDTO);
    }
}
