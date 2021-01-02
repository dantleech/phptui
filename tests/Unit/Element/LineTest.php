<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\BlockBrush;
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
        yield 'one, one' => [
            new Line(new Position(1, 1), new Position(1, 1), brush: new BlockBrush()),
            <<<EOT
..
..
█.
EOT
        ];

        yield 'vertical' => [
            new Line(new Position(1, 1), new Position(1, 4)),
            <<<EOT
│
│
│
│
EOT
        ];

        yield 'diagonal' => [
            new Line(new Position(1, 1), new Position(4, 4)),
            <<<EOT
...╱
..╱.
.╱..
╱...
EOT
        ];

        yield 'down' => [
            new Line(new Position(1, 4), new Position(4, 1)),
            <<<EOT
╲...
.╲..
..╲.
...╲
EOT
        ];


        yield 'diagonal 2' => [
            new Line(new Position(1, 1), new Position(2, 6), brush: new BlockBrush()),
            <<<EOT
.█..
.█..
.█..
█...
█...
█...
EOT
        ];
    }
}
