<?php

namespace DTL\ConsoleCanvas\Brush;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Rune;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

final class BlockBrush implements Brush
{
    public function stroke(Stroke $stroke): Rune
    {
        return new Rune('█');
    }
}
