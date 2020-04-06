<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use stringEncode\Encode;

/**
 * @internal
 */
final class EncodeTest extends TestCase
{
    public function testTo()
    {
        $encode = new Encode();
        $encode->to('ISO-8859-1');
        static::assertSame('ISO-8859-1', $encode->charset()['to']);
    }

    public function testFrom()
    {
        $encode = new Encode();
        $encode->from('ISO-8859-1');
        static::assertSame('ISO-8859-1', $encode->charset()['from']);
    }

    public function testDetect()
    {
        $encode = new Encode();
        $encode->detect('Calendrier de l\'avent façon Necta!');
        static::assertSame('UTF-8', $encode->charset()['from']);
    }

    public function testCovertToIsoAutoDetect()
    {
        $str = '-ABC-中文空白-';

        $encode = new Encode();
        $encode->to('ISO-8859-1');
        $encode->detect($str);
        static::assertSame('-ABC-????-', $encode->convert($str));
    }

    public function testCovertToUtf8AutoDetect()
    {
        $str = '-ABC-中文空白-';

        $encode = new Encode();
        $encode->to('UTF-8');
        $encode->detect($str);
        static::assertSame('-ABC-中文空白-', $encode->convert($str));
    }

    public function testCovertToUtf8DoubleNonError()
    {
        $str = '-ABC-中文空白-';

        $encode = new Encode();
        $encode->to('UTF-8');
        $encode->from('ISO-8859-1');
        static::assertSame('-ABC-中文空白-', $encode->convert($str));
    }

    public function testCovertToHtml()
    {
        $str = '-ABC-中文空白-';

        $encode = new Encode();
        $encode->to('HTML');
        $encode->detect($str);
        static::assertSame('-ABC-&#20013;&#25991;&#31354;&#30333;-', $encode->convert($str));
    }

    public function testCovertToUtf8()
    {
        $str = '&#233;&#224;a';

        $encode = new Encode();
        $encode->to('UTF-8');
        $encode->from('HTML');
        static::assertSame('éàa', $encode->convert($str));
    }

    public function testCovertToBase64()
    {
        $str = '-ABC-中文空白-';

        $encode = new Encode();
        $encode->to('BASE64');
        $encode->detect($str);
        static::assertSame('LUFCQy3kuK3mlofnqbrnmb0t', $encode->convert($str));
    }

    public function testDetectUtf16AndRemoveTheBom()
    {
        $str = \file_get_contents(__DIR__ . '/fixtures/sample-utf-16-le-bom.txt');

        $encode = new Encode();
        $encode->to('UTF8');
        $encode->detect($str);
        static::assertContains(
            'Greek (monotonic): Μπορώ να φάω σπασμένα γυαλιά χωρίς να πάθω τίποτα.',
            $encode->convert($str)
        );
    }

    public function testDetectUtt8AndRemoveTheBom()
    {
        $str = \file_get_contents(__DIR__ . '/fixtures/sample-utf-8-bom.txt');

        $encode = new Encode();
        $encode->to('UTF-8');
        $encode->detect($str);
        static::assertContains(
            'Greek (monotonic): Μπορώ να φάω σπασμένα γυαλιά χωρίς να πάθω τίποτα.',
            $encode->convert($str)
        );
    }
}
