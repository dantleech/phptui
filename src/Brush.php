<?php

namespace DTL\ConsoleCanvas;

interface Brush
{
    public function stroke(Stroke $stroke): Rune;
}
