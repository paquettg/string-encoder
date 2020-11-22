<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;

class Validator
{
    /**
     * @internal
     */
    public function validateEncoding(string $encoding, bool $caseSensitive): bool
    {
        return $this->determineEncoding($encoding, $caseSensitive) !== null;
    }

    /**
     * @internal
     */
    public function determineEncoding(string $encoding, bool $caseSensitive): ?string
    {
        $encodingList = \mb_list_encodings();

        foreach ($encodingList as $validEncoding) {
            if ($validEncoding === $encoding || (
                    $caseSensitive === false &&
                    mb_convert_case($validEncoding, MB_CASE_LOWER) === mb_convert_case($encoding, MB_CASE_LOWER))
                ) {
                return $validEncoding;
            }
            if ($this->validateEncodingAlias($encoding, $validEncoding, $caseSensitive)) {
                return $validEncoding;
            }
        }

        // no valid encoding string found that matches
        return null;
    }

    public function validateString(string $string, EncodingDTOInterface $encodingDTO): bool
    {
        $encoding = \mb_detect_encoding($string, [$encodingDTO->getEncoding()]);

        return $encoding === $encodingDTO->getEncoding();
    }

    /**
     * @internal
     */
    private function validateEncodingAlias(string $encoding, string $validEncoding, bool $caseSensitive): bool
    {
        if ($caseSensitive) {
            $aliasEncoding = \mb_encoding_aliases($validEncoding);
        } else {
            $encoding = mb_convert_case($encoding, MB_CASE_LOWER);
            $aliasEncoding = $this->lowerCaseArray(\mb_encoding_aliases($validEncoding));
        }

        return \in_array($encoding, $aliasEncoding);
    }

    /**
     * @internal
     * @param string[] $encodings
     * @return string[]
     */
    private function lowerCaseArray(array $encodings): array
    {
        $newEncodings = [];
        foreach ($encodings as $key => $encoding) {
            $newEncodings[$key] = mb_convert_case($encoding, MB_CASE_LOWER);
        }

        return $newEncodings;
    }
}
