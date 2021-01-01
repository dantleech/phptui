<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element\Box;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Series;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Style;

$canvas = new Buffer(width: 120, height: 25);

$container = new Container(100, 30);
$wave = fn(int $offset, int $scale = 10) => array_map(
    fn (float $radian) => sin($radian % 360) * $scale,
    range($offset, $offset + 359)
);
$series1 = new Series(
    $wave(0),
    step: 4,
    style: new Style(fg: Color::red())
);
$series2 = new Series(
    $wave(0),
    step: 10,
    style: new Style(fg: Color::green()),
    brush: new LineBrush(),
);
$series3 = new Series(
    $wave(0),
    step: 20,
    density: 20,
    style: new Style(fg: Color::magenta())
);

$container->place(new Position(0, 0), new Text(str_repeat('-', 200)));
$container->place(new Position(0, 20), $series1);
$container->place(new Position(0, 20), $series2);
$container->place(new Position(0, 10), $series3);
$container->place(new Position(0, 32), new Text(str_repeat('-', 200)));

$subLayer = new Container(100, 100);
$subLayer->place(new Position(0, 0), new Text('Hello'));
$container->place(new Position(0, 0), $subLayer);

$sleep = 10_000;
$offset = 0;

while (true) {
    $offset += 1;
    $canvas->clear();
    $container->render($canvas);
    $container->update($series1, fn (Series $series) => $series->values = $wave($offset));
    echo $canvas->render();
    usleep($sleep);
}
