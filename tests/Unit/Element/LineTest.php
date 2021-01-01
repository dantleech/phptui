<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element\Line;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class LineTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Line $path, string $expected): void
    {
        self::assertCanvas($expected, $path);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield 'vertical' => [
            new Line(new Position(0, 0), new Position(0, 4)),
            <<<EOT
│
│
│
│
EOT
        ];

        yield 'diagonal' => [
            new Line(new Position(0, 0), new Position(3, 3)),
            <<<EOT
...╱
..╱.
.╱..
╱...
EOT
        ];
    }
}
