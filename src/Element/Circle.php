<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;

final class Circle implements Element
{
    public Brush $brush;

    public function __construct(
        public float $radius,
        ?Brush $brush = null,
    )
    {
        $this->radius = $radius;
        $this->brush = $brush ?: new BlockBrush();
    }

    public function render(Buffer $buffer): void
    {
        for ($d = 0; $d < 360; $d++) {

            $x = $this->radius * sin(M_PI * 2 * $d / 360) + $this->radius;
            $y = $this->radius * cos(M_PI * 2 * $d / 360) + $this->radius;

            $buffer->print(new Position($x, $y), $this->brush->stroke(new Stroke(angle: $d)));
        }
    }
}
