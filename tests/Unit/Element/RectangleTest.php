<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\Char;
use DTL\ConsoleCanvas\Brush\LineBrush;
use Generator;
use PHPUnit\Framework\TestCase;

class RectangleTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Rectangle $rectangle, string $expected): void
    {
        self::assertCanvas($expected, $rectangle);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield 'rectangle' => [
            new Rectangle(width: 3, height: 3, brush: new BlockBrush()),
            <<<EOT
....
███.
█ █.
███.
EOT
        ];

        yield 'rectangle with border' => [
            new Rectangle(width: 10, height: 3, brush: new LineBrush()),
            <<<EOT
┌────────┐
│        │
└────────┘
EOT
        ];

        yield 'filled rectangle' => [
            new Rectangle(width: 10, height: 3, fillBrush: new BlockBrush()),
            <<<EOT
██████████
██████████
██████████
EOT
        ];

        yield 'filled rectangle with fill brush' => [
            new Rectangle(width: 10, height: 3, fillBrush: new BlockBrush(), brush: new LineBrush()),
            <<<EOT
┌────────┐
│████████│
└────────┘
EOT
        ];
    }
}
