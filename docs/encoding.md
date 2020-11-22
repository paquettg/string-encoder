# Encoding

- [Contracts](#contracts)
- [Encoding](#encoding)
- [Options](#options)
- [Proxy](#proxy)

## Contracts

Each part of this package which is intended for public usage has an associated contract interface which will not be changed without a major version update. The contract interfaces are used for dependency which will allow you to insert your own behavior into the package. We will be covering the following contract interfaces in this document.

- [Encoder](src/StringEncoder/Contracts/EncoderInterface.php)
- [Convert Read](src/StringEncoder/Contracts/ConvertReadInterface.php)
- [Convert Write](src/StringEncoder/Contracts/ConvertWriteInterface.php)
- [Options](src/StringEncoder/Contracts/OptionsInterface.php)
- [Proxy Encoder](src/StringEncoder/Contracts/ProxyEncoderInterface.php)

## Encoding

### Basics

Encoding is the primary functionality provided by this package and will allow you to quickly convert strings from one encoding to another. By default, we attempt to detect the encoding and convert the provided string to `UTF-8`. Here is a basic example of how this would work with all default values.

```php
<?php

use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in UTF-8 encoding (default)
```

### Setting a target and source encoding

If you want to change the target encoding, or set a specific encoding, you can do this in the encoder before calling convert. When setting the encoding we will check if it is a valid encoding for the system and throw a `InvalidEncodingException` error if the encoding is not supported.

```php
<?php

use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$encoder->setSourceEncoding('ISO-8859-1'); // This is the source encoding that will be used, we will not auto-detect the encoding.
$encoder->setTargetEncoding('US-ASCII'); // This is the target encoding, defaults to 'UTF-8'.
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in US-ASCII encoding
```

### Read sources

Currently, we only support loading from strings, as the examples above show. We will add additional ways to read sources in future versions. If you have any suggestions please let us know by opening an issue.

### Write sources

The `ConvertWriteInterface` allows you to both convert the string to another string or a DTO. This allows you the flexibility to decide how you want to receive the data from the convert action.

#### Write to DTO

```php
<?php

use StringEncoder\Encoder;

$str          = "Calendrier de l'avent façon Necta!";
$encoder      = new Encoder();
$MBStringDTO  = $encoder->convert()->fromString($str)->toDTO();
echo $MBStringDTO->getString(); // "Calendrier de l'avent façon Necta!" in UTF-8 encoding (default)
echo $MBStringDTO->getEncodingDTO()->getEncoding(); // "UTF-8" as this is the default encoding.
```

## Options

Some functionality provided by the package can be controlled by passing an option object to the encoding object.

### Default target encoding

If you want to change the default target encoding you can modify the value in `$defaultTargetEncoding` inside an option object. This sets the default target encoding when none is set manually in the encoder.

```php
<?php

use StringEncoder\Encoder;
use StringEncoder\Options;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$encoder->setOptions(
    (new Options())->setDefaultTargetEncoding('US-ASCII')
);
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in US-ASCII encoding (default)
```

### Remove UTF-8 BOM

This option determined if we remove the `UTF-8` BOM from the result when `UTF-8` is the target encoding. This defaults to `false`.

```php
<?php

use StringEncoder\Encoder;
use StringEncoder\Options;

$str     = "\xef\xbb\xbfCalendrier de l'avent façon Necta!";
$encoder = new Encoder();
$encoder->setOptions(
    (new Options())->setRemoveUTF8BOM(true)
);
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in UTF-8 encoding, with out the BOM
```

## Proxy

The package provides the ability to create both a proxy and to call all the methods in the encoder using a static call. 

### Mounting

Mounting will create a class alias and allow you to access the encoder from anywhere in the code base.

```php
<?php

use StringEncoder\Proxy\Encoder;

Encoder::mountFromEncoding('ISO-8859-1', 'UTF-8');
$str    = "Calendrier de l'avent façon Necta!";
$newstr = Encoder::convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in ISO-8859-1 encoding
```
