<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\DTO\MBStringDTOInterface;
use StringEncoder\Contracts\MB\RegexInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\Exceptions\InvalidEncodingException;

class Regex implements RegexInterface
{
    /**
     * @throws InvalidEncodingException
     */
    public function setEncoding(string $encoding): void
    {
        $encodingDTO = EncodingDTO::makeFromString($encoding);
        \mb_regex_encoding($encodingDTO->getEncoding());
    }

    public function getEncoding(): string
    {
        return \mb_regex_encoding();
    }

    /**
     * @throws InvalidEncodingException
     */
    public function replace(
        string $pattern,
        string $replace,
        MBStringDTOInterface $MBStringDTO,
        bool $ignoreCase = false
    ): MBStringDTOInterface {
        if ($ignoreCase) {
            $value = \mb_eregi_replace($pattern, $replace, $MBStringDTO->getString());
        } else {
            $value = \mb_ereg_replace($pattern, $replace, $MBStringDTO->getString());
        }

        return MBStringDTO::makeFromDTO($value, $MBStringDTO);
    }

    /**
     * @param string[] $patterns
     * @param string[] $replaces
     *
     * @throws InvalidEncodingException
     */
    public function replaceMultiple(
        array $patterns,
        array $replaces,
        MBStringDTOInterface $MBStringDTO,
        bool $ignoreCase = false
    ): MBStringDTOInterface {
        foreach ($patterns as $key => $pattern) {
            $replace = $replaces[$key];
            $MBStringDTO = $this->replace($pattern, $replace, $MBStringDTO, $ignoreCase);
        }

        return $MBStringDTO;
    }
}
