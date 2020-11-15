<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;

class Validator
{
    /**
     * @internal
     */
    public function validateEncoding(string $encoding): bool
    {
        $encodingList = \mb_list_encodings();
        $valid = false;
        if (!\in_array($encoding, $encodingList)) {
            // encoding not found in encoding list, checking aliases
            foreach ($encodingList as $validEncoding) {
                if ($this->validateEncodingAlias($encoding, $validEncoding)) {
                    $valid = true;
                    break;
                }
            }
        } else {
            $valid = true;
        }

        return $valid;
    }

    public function validateString(string $string, EncodingDTOInterface $encodingDTO): bool
    {
        $encoding = \mb_detect_encoding($string, [$encodingDTO->getEncoding()]);

        return $encoding === $encodingDTO->getEncoding();
    }

    private function validateEncodingAlias(string $encoding, string $validEncoding): bool
    {
        $aliasEncoding = \mb_encoding_aliases($validEncoding);

        return \in_array($encoding, $aliasEncoding);
    }
}
