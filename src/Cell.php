<?php

namespace DTL\ConsoleCanvas;

final class Cell
{
    public function __construct(private Rune $rune, private Style $style)
    {
    }

    public function rune(): Rune
    {
        return $this->rune;
    }

    public function style(): Style
    {
        return $this->style;
    }
}
