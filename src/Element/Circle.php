<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Style;

final class Circle implements Element
{
    public Brush $brush;

    public function __construct(
        public float $radius,
        ?Brush $brush = null,
        public ?Style $style = null,
        public ?Brush $fillBrush = null,
        public ?Style $fillStyle = null,
    )
    {
        $this->brush = $brush ?: new BlockBrush();
    }

    public function render(Buffer $buffer): void
    {
        $positions = [];
        $strokes = [];
        
        for ($d = 0; $d < 360; $d++) {

            $x = $this->radius * sin(M_PI * 2 * $d / 360) + $this->radius + 1;
            $y = $this->radius * cos(M_PI * 2 * $d / 360) + $this->radius + 1;

            $position = Position::fromFloat($x, $y);

            $positions[] = $position;
            $strokes[] = $this->brush->stroke(new Stroke(angle: 360 - $d));
        }

        $positions = new Positions($positions);
        $this->fill($positions, $buffer);

        foreach ($positions as $index => $position) {
            $buffer->print(
                $position,
                $strokes[$index],
                $this->style
            );
        }
    }

    private function fill(Positions $positions, Buffer $buffer): void
    {
        if (null === $this->fillBrush) {
            return;
        }
        foreach ($positions->rowRanges()->fromY(1) as $range) {
            for ($x = $range->start()->x() + 1; $x < $range->end()->x(); $x++) {
                $buffer->print(
                    new Position($x, $range->start()->y()),
                    $this->fillBrush->stroke(new Stroke()),
                    $this->fillStyle
                );
            }

        }
    }
}
