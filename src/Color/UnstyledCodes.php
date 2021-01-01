<?php

namespace DTL\ConsoleCanvas\Color;

use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\ColorCodes;

final class UnstyledCodes implements ColorCodes
{
    public function render(Color $color): string
    {
        return '';
    }
}
