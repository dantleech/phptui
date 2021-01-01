<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;

interface Element
{
    public function render(Buffer $buffer): void;
}
