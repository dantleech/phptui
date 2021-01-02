<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Line;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Style;

$canvas = new Buffer(width: 101, height: 31);

$container = new Container(101, 31);
$border = new Rectangle(100, 30, brush: new LineBrush());
$container->place(new Position(1, 1), $border);

$graph = new Container(90, 25);
for ($i = 1; $i < 80; $i += 4) {
    $value = rand(1, 10);
    $bar = new Rectangle(
        2,
        $value,
        fillBrush: new BlockBrush(),
        fillStyle: new Style(Color::blue())
    );
    $graph->place(new Position($i, 1), $bar);
}
$container->place(new Position(10, 10), $graph);

$container->render($canvas);
echo $canvas->render();
