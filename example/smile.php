<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;

$buffer = new Buffer(width: 32, height: 32);
$circle = new Circle(15, brush: new LineBrush());
$border = new Rectangle(width: 31, height: 31, brush: new LineBrush());
$container = Container::fromBuffer($buffer);
$container->place(new Position(0, 0), $circle);
$container->place(new Position(0, 0), $border);
$container->render($buffer);


echo $buffer->render();
