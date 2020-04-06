<?php

declare(strict_types=1);

namespace stringEncode;

class Encode
{
    /**
     * The encoding that the string is currently in.
     *
     * @var string
     */
    protected $from;

    /**
     * The encoding that we would like the string to be in.
     *
     * @var string
     */
    protected $to;

    /**
     * Sets the default charsets for the package.
     */
    public function __construct()
    {
        // default from encoding
        $this->from = 'CP1252';

        // default to encoding
        $this->to = 'UTF-8';
    }

    /**
     * Sets the charset that we will be converting to.
     *
     * @param string $charset
     *
     * @return $this
     *
     * @chainable
     */
    public function to($charset): Encode
    {
        $this->to = \voku\helper\UTF8::normalize_encoding($charset);

        return $this;
    }

    /**
     * Sets the charset that we will be converting from.
     *
     * @param string $charset
     *
     * @chainable
     */
    public function from($charset): void
    {
        $this->from = \voku\helper\UTF8::normalize_encoding($charset);
    }

    /**
     * Returns the to and from charset that we will be using.
     *
     * @return array
     */
    public function charset(): array
    {
        return [
            'from' => $this->from,
            'to'   => $this->to,
        ];
    }

    /**
     * Attempts to detect the encoding of the given string from the encodingList.
     *
     * @param string|null $str
     *
     * @return bool
     */
    public function detect($str = null): bool
    {
        $charset = \voku\helper\UTF8::str_detect_encoding($str);
        if ($charset === false) {
            // could not detect charset
            return false;
        }

        $this->from = $charset;

        return true;
    }

    /**
     * Attempts to convert the string to the proper charset.
     *
     * @param string $str
     *
     * @return string
     */
    public function convert($str): string
    {
        if ($this->from != $this->to) {
            $str = \voku\helper\UTF8::encode(
                $this->to,
                $str,
                false,
                $this->from
            );
        }

        // deal with BOM issue for utf-8 / utf-16 / utf-32 text
        if (\voku\helper\UTF8::str_contains($this->to, 'UTF')) {
            $str = \voku\helper\UTF8::remove_bom($str);
        }

        return $str;
    }
}
