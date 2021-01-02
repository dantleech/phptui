<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\RuneBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class PathTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Path $path, string $expected): void
    {
        self::assertCanvas($expected, $path);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield [
            new Path(Positions::fromPairs([
                [ 1, 1 ], [ 10, 1 ],
            ]), brush: RuneBrush::fromChar('x')),
            'xxxxxxxxxx'
        ];
        yield [
            new Path(Positions::fromPairs([
                [ 1, 1 ], [ 1, 4 ]
            ]), brush: RuneBrush::fromChar('x')),
            <<<EOT
x
x
x
x
EOT
        ];
        yield 'diagnonal' => [
            new Path(Positions::fromPairs([
                [ 1, 1 ], [ 4, 4 ]
            ]), brush: RuneBrush::fromChar('x')),
            <<<EOT
...x.
..x..
.x...
x....
EOT
        ];
        yield 'saw' => [
            new Path(Positions::fromPairs([
                [ 1, 1 ], [ 4, 4 ], [ 7, 1 ]
            ]), brush: RuneBrush::fromChar('x')),
            <<<EOT
...x....
..x.x...
.x...x..
x.....x.
EOT
        ];
        yield 'triangle' => [
            new Path(Positions::fromPairs([
                [ 1, 1 ], [ 4, 4 ], [ 4, 1 ], [ 1, 1 ]
            ]), brush: RuneBrush::fromChar('x')),
            <<<EOT
...x.
..xx.
.x.x.
xxxx.
EOT
        ];

        yield 'box' => [
            new Path(Positions::fromPairs([
                [ 1, 1 ],
                [ 1, 5 ],
                [ 5, 5 ],
                [ 5, 1 ],
                [ 1, 1 ],
            ]), brush: RuneBrush::fromChar('x')),
            <<<EOT
xxxxx
x...x
x...x
x...x
xxxxx
EOT
        ];
    }
}
