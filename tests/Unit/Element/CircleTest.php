<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Line;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class CircleTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender( $element, string $expected): void
    {
        self::assertCanvas($expected, $element);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield 'blocks' => [
            new Circle(radius: 2),
            <<<EOT
 ███ 
██ ██
█   █
██ ██
 ███ 
EOT
        ];

        yield 'lines' => [
            new Circle(radius: 2, brush: new LineBrush()),
            <<<EOT
.──╲.
╱╱.╲│
│...│
│╲.╱╱
.╲──.
EOT
        ];
    }
}
