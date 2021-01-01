<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Style;

final class Series implements Element
{
    public Brush $brush;
    public Style $style;

    public function __construct(
        public array $values,
        public int $density = 10,
        public int $step = 1,
        ?Brush $brush = null,
        ?Style $style = null,
    )
    {
        $this->brush = $brush ?: new BlockBrush();
        $this->style = $style ?: Style::none();
    }

    public function render(Buffer $canvas): void
    {
        $startY = null;
        $positions = [];
        $x = 0;
        foreach (array_values($this->values) as $y) {
            $positions[] = new Position($x, $y,);
            $x += $this->step;
        }

        (new Path(
            new Positions($positions),
            density: $this->density,
            brush: $this->brush,
            style: $this->style,
        ))->render($canvas);
    }

    public function withValues(array $values): self
    {
        $new = clone $this;
        $new->values = $values;
        return $new;
    }
}
