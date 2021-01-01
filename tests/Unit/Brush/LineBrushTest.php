<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Brush;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\LineBrush;
use Generator;
use PHPUnit\Framework\TestCase;

class LineBrushTest extends TestCase
{
    /**
     * @dataProvider provideStroke
     */
    public function testStroke(Brush $brush, Stroke $stroke, string $expected): void
    {
        self::assertEquals($expected, $brush->stroke($stroke));
    }

    /**
     * @return Generator<mixed>
     */
    public function provideStroke(): Generator
    {
        yield [
            new LineBrush(),
            new Stroke(),
            '─',
        ];
        yield [
            new LineBrush(),
            new Stroke(angle: 90),
            '│',
        ];
        yield [
            new LineBrush(),
            new Stroke(angle: 45),
            '╱',
        ];
        yield [
            new LineBrush(),
            new Stroke(angle: 135),
            '╲',
        ];

        yield 'intersection north' => [
            new LineBrush(),
            new Stroke(intersection: true, angle: 0),
            '┴',
        ];

        yield 'intersection south' => [
            new LineBrush(),
            new Stroke(intersection: true, angle: 180),
            '┬',
        ];

        yield 'intersection east' => [
            new LineBrush(),
            new Stroke(intersection: true, angle: 90),
            '├',
        ];

        yield 'intersection west' => [
            new LineBrush(),
            new Stroke(intersection: true, angle: 270),
            '┤',
        ];
    }
}
