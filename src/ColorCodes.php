<?php

namespace DTL\ConsoleCanvas;

interface ColorCodes
{
    public function render(Color $color): string;
}
