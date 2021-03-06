<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Brush\RuneBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Line;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use DTL\ConsoleCanvas\Style;
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

        yield 'filled' => [
            new Circle(radius: 2, fillBrush: RuneBrush::fromChar('x')),
            <<<EOT
 ███ 
██x██
█xxx█
██x██
 ███ 
EOT
        ];

        yield 'filled style' => [
            new Circle(radius: 2, fillBrush: RuneBrush::fromChar('x'), fillStyle: new Style(fg: Color::green())),
            <<<EOT
 ███ 
██x██
█xxx█
██x██
 ███ 
EOT
        ];

        yield 'styled' => [
            new Circle(radius: 2, fillBrush: RuneBrush::fromChar('x'), style: new Style(fg: Color::green())),
            <<<EOT
 ███ 
██x██
█xxx█
██x██
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
