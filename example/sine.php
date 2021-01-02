<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element\Box;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Element\Series;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Style;

$canvas = new Buffer(width: 100, height: 25);

$container = new Container(100, 30);
$border = new Rectangle(
    width: 100,
    height: 24,
    brush: new LineBrush(),
    style: new Style(Color::white())
);

$wave = fn(int $offset, int $scale = 10) => array_map(
    fn (float $radian) => ((sin($radian % 360)) * $scale) + 12.4,
    range($offset, $offset + 40)
);
$series1 = new Series(
    $wave(1),
    step: 4,
    style: new Style(fg: Color::red())
);
$series2 = new Series(
    $wave(1),
    step: 10,
    style: new Style(fg: Color::green()),
    brush: new LineBrush(),
);
$series3 = new Series(
    $wave(1),
    step: 20,
    style: new Style(fg: Color::magenta())
);

$graph = new Container(90, 25);
for ($i = 1; $i < 80; $i += 5) {
    $value = rand(1, 20);
    $bar = new Rectangle(
        4,
        $value,
        brush: new LineBrush(),
        fillBrush: new BlockBrush(),
        fillStyle: new Style(Color::blue())
    );
    $graph->place(new Position($i, 1), $bar);
}

$container->place(new Position(1, 1), new Text(str_repeat('-', 200)));
$container->place(new Position(1, 1), $series1);
$container->place(new Position(1, 1), $series2);
$container->place(new Position(1, 1), $series3);
$container->place(new Position(1, 32), new Text(str_repeat('-', 200)));
$container->place(new Position(10, 1), $graph);
$container->place(new Position(1, 1), $border);
$text = new Text('Happy New Year!!!');
$container->place(new Position(2, 1), $text);


$sleep = 40_000;
$offset = 1;

while (true) {
    $offset += 1;
    $canvas->clear();

    $container->render($canvas);
    $series1->values = $wave($offset);
    $graph->updateClass(
        Rectangle::class,
        fn (Rectangle $rectangle) => $rectangle->height = max($rectangle->height + rand(-1, 1), 1)
    );
    if ($offset % 2) {
        $container->move($text, fn (Position $position) => $position->withX(1 + ($position->x() + 1) % 100));
    }

    echo $canvas->render();
    usleep($sleep);
}
