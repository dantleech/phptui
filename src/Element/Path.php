<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Style;

final class Path implements Element
{
    public Brush $brush;
    public Style $style;

    public function __construct(
        public Positions $positions,
        public int $density = 100,
        ?Brush $brush = null,
        ?Style $style = null,
    )
    {
        $this->brush = $brush ?: new LineBrush();
        $this->style = $style ?: Style::none();
    }

    public function render(Buffer $canvas): void
    {
        $start = null;
        $plots = [];
        foreach ($this->positions as $end) {
            if ($start === null) {
                $start = $end;
                continue;
            }

            (new Line(
                $start,
                $end,
                density: $this->density,
                brush: $this->brush,
                style: $this->style,
            ))->render($canvas,);

            $start = $end;
        }
    }
}
