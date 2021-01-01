<?php

namespace DTL\ConsoleCanvas\Brush;

use DTL\ConsoleCanvas\Rune;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

final class LineBrush implements Brush
{
    private const CHARS = ['╱', '│', '╲', '─'];
    private const INTERSECTIONS = ['┴', '└', '├', '┌', '┬', '┐', '┤', '┘'];

    public function stroke(Stroke $stroke): Rune
    {
        $angle = $stroke->angle();

        if ($stroke->intersection()) {
            $offset = intval($angle / (360 / 8));
            return new Rune(self::INTERSECTIONS[$offset % 8]);
        }

        $angle -= 22.5;
        $angle = $angle < 0 ? (360 - abs($angle)) : $angle;
        $angle = $angle % 360;
        $offset = intval($angle / (360 / 8));

        return new Rune(self::CHARS[$offset % 4]);
    }
}
