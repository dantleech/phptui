<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\LineBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Style;

/**
 * Render a line in the grid.
 *
 *
 * From (x:0,y:0) to (x:0,y:1)
 *
 *    +---+---+---+---+
 *   4|   |   |   |   |
 *    +---+---+---+---+
 *   3|   |   |   |   |
 * Y  +---+---+---+---+
 *   2| x |   |   |   |
 *    +---+---+---+---+
 *   1| x |   |   |   |
 *    +---+---+---+---+
 *      1   2   3  
 *            X
 */
class Line implements Element
{
    public Brush $brush;
    public Style $style;

    public function __construct(
        public Position $start,
        public Position $end,
        ?Brush $brush = null,
        ?Style $style = null,
    )
    {
        $this->brush = $brush ?: new LineBrush();
        $this->style = $style ?: Style::none();
    }

    public function render(Buffer $buffer): void
    {
        $nbPoints = max(
            self::nbPoints($this->start->x(), $this->end->x()),
            self::nbPoints($this->start->y(), $this->end->y()),
        );
        $xSeries = $this->series($this->start->x(), $this->end->x(), $nbPoints);
        $ySeries = $this->series($this->start->y(), $this->end->y(), $nbPoints);

        $lastX = null;
        $lastY = null;

        $angle = -atan2(
            $this->end->y() - $this->start->y(),
            $this->end->x() - $this->start->x()
        ) * 180 / M_PI;

        foreach ($xSeries as $index => $x) {
            $y = $ySeries[$index];

            $buffer->print(
                new Position($x, $y),
                $this->brush->stroke(new Stroke(angle: 360 - $angle)),
                $this->style
            );
        }
    }

    private function series(int $start, int $end, int $nbPoints): array
    {
        $delta = ($end - $start) / $nbPoints;

        return array_reduce(range(1, $nbPoints), function (array $points, int $index) use ($start, $delta) {
            $points[] = round(($start + ($delta * $index)));
            return $points;
        }, [$start]);
    }

    private static function nbPoints(int $n1, int $n2): int
    {
        $start = min($n1, $n2);
        $end = max($n1, $n2);
        return ($end - $start) + 1;
    }
}
