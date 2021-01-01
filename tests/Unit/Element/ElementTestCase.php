<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color\SymfonyConsoleCodes;
use DTL\ConsoleCanvas\Color\UnstyledCodes;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use PHPUnit\Framework\TestCase;

class ElementTestCase extends TestCase
{
    protected static function assertCanvas(string $expected, Element $element): void
    {
        $canvas = Buffer::fromTextDimensions($expected, new UnstyledCodes());
        $element->render($canvas);
        $rendered = $canvas->render();

        // temporarily strip ANSI codes until palette is implemented
        $expected = str_replace('.', ' ', $expected);
        $rendered = preg_replace('#\\x1b[[][^A-Za-z]*[A-Za-z]#', '', $rendered);
        if ($expected !== $rendered) {
            self::fail(sprintf(
                "Actual:\n---\n%s\n----\ndid not match expected:\n----\n%s\n----",
                str_replace(' ', '.', $rendered),
                str_replace(' ', '.', $expected),
            ));
        }
        self::assertEquals($expected, $rendered);
    }
}
