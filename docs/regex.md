# Regex

- [Contracts](#contracts)
- [MB](#mb)

## Contracts

Each part of this package which is intended for public usage has an associated contract interface which will not be changed without a major version update. The contract interfaces are used for dependency which will allow you to insert your own behavior into the package. We will be covering the following contract interfaces in this document.

- [Encoder](src/StringEncoder/Contracts/MB/RegexInterface)

## MB

### Basics

The functionality covered by this contract supports regex for MB strings. It leverages the encoding functionality and validation from the encoder to ensure a safer execution of the regex.

```php
<?php

use StringEncoder\MB\Regex;
use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$MBStringDTO = $encoder->convert()->fromString($str)->toDTO();

$regex = new Regex();
$ResultMBStringDTO = $regex->replace('[^A-Za-z0-9\.\-]', '', $MBStringDTO);
echo $ResultMBStringDTO->getString(); // "Calendrierdelaventfaonnecta" in UTF-8 encoding.
```

### Setting encoding

You can set the encoding to be used by the regex functionality. The encoding that is passed is validated to ensure that it can be used by the system and will throw a `InvalidEncodingException` error if it is not supported.

```php
<?php

use StringEncoder\MB\Regex;
use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$encoder->setTargetEncoding('ASCII');
$MBStringDTO = $encoder->convert()->fromString($str)->toDTO();

$regex = new Regex();
$regex->setEncoding('ASCII');
$ResultMBStringDTO = $regex->replace('[^A-Za-z0-9\.\-]', '', $MBStringDTO);
echo $ResultMBStringDTO->getString(); // "Calendrierdelaventfaonnecta" in ASCII encoding.
```
