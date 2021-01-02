<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use Closure;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class ContainerTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Closure $factory, string $expected): void
    {
        self::assertCanvas($expected, $factory());
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield [
            function () {
                $c = new Container(10, 10);
                $c->place(new Position(1, 1), new Text('Hello'));
                return $c;
            },
            <<<EOT
..........
..........
..........
..........
..........
..........
..........
..........
..........
Hello.....
EOT
        ];

        yield 'respects container boundary' => [
            function () {
                $c1 = new Container(10, 2);
                $c2 = new Container(4, 2);
                $c2->place(new Position(1, 1), new Text('Hello Hello Hello'));
                $c1->place(new Position(1, 1), $c2);
                return $c1;
            },
            <<<EOT
..........
Hell......
EOT
        ];

        yield 'update element' => [
            function () {
                $c1 = new Container(10, 2);
                $element = new Text('Hello Hello Hello');
                $c1->place(new Position(1, 1), $element);
                $c1->update($element, fn (Text $text) => $text->text = 'Goodbye');
                return $c1;
            },
            <<<EOT
..........
Goodbye...
EOT
        ];
    }
}
