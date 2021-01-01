<?php

namespace DTL\ConsoleCanvas;

class Style
{
    private Color $fg;
    private Color $bg;

    public function __construct(
        ?Color $fg = null
    )
    {
        $this->fg = $fg ?: Color::none();
        $this->bg = Color::none();
    }

    public static function none(): self
    {
        return new self();
    }

    public function fg(): Color
    {
        return $this->fg;
    }

    public function bg(): Color
    {
        return $this->bg;
    }
}
