<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Style;

class Line implements Element
{
    public Brush $brush;
    public Style $style;

    public function __construct(
        public Position $start,
        public Position $end,
        public int $density = 100,
        ?Brush $brush = null,
        ?Style $style = null
    )
    {
        $this->brush = $brush ?: new LineBrush();
        $this->style = $style ?: Style::none();
    }

    public function render(Buffer $buffer): void
    {
        $xSeries = $this->series($this->start->x(), $this->end->x());
        $ySeries = $this->series($this->start->y(), $this->end->y());

        $lastX = null;
        $lastY = null;

        $angle = -atan2(
            $this->end->y() - $this->start->y(),
            $this->end->x() - $this->start->x()
        ) * 180 / M_PI;

        foreach ($xSeries as $index => $x) {
            $y = $ySeries[$index];

            $buffer->print(Position::fromFloat($x, $y), $this->brush->stroke(new Stroke(angle: 360 - $angle)), $this->style);
        }
    }

    private function series(float $start, float $end): array
    {
        $delta = ($end - $start) / $this->density;

        return array_reduce(range(0, $this->density), function (array $points, int $index) use ($start, $delta) {
            $points[] = $start + ($delta * $index);
            return $points;
        }, []);
    }
}
