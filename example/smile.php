<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Style;

$buffer = new Buffer(width: 33, height: 33);

$circle = new Circle(
    radius: 15,
    style: new Style(fg: Color::cyan()),
    fillBrush: new BlockBrush(),
    fillStyle: new Style(fg: Color::yellow())
);

$eye = new Circle(
    radius: 1,
    style: new Style(fg: Color::black()),
    fillBrush: new BlockBrush(),
    fillStyle: new Style(fg: Color::red()),
);

$smile = new Path(new Positions([
    new Position(0, 5),
    new Position(9, 5),
    new Position(18, 5),
    new Position(14, 0),
    new Position(4, 0),
    new Position(0, 5),
]));

$border = new Rectangle(
    width: 32,
    height: 32,
    brush: new LineBrush()
);

$container = Container::fromBuffer($buffer);
$container->place(new Position(1, 1), $circle);
$container->place(new Position(10, 20), $eye);
$container->place(new Position(20, 20), clone $eye);
$container->place(new Position(0, 0), $border);
$container->place(new Position(7, 8), $smile);
$container->render($buffer);

echo $buffer->render();
