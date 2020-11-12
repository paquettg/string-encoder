<?php

declare(strict_types=1);

namespace StringEncoder\MB;

class Validator
{
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

    private function validateEncodingAlias(string $encoding, string $validEncoding): bool
    {
        $aliasEncoding = \mb_encoding_aliases($validEncoding);

        return \in_array($encoding, $aliasEncoding);
    }
}
