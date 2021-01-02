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
        $x = 1;
        foreach (array_values($this->values) as $y) {
            if ($y < 1) {
                dump($y);
                continue;
            }

            $positions[] = new Position($x, $y);
            $x += $this->step;
        }

        (new Path(
            new Positions($positions),
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
