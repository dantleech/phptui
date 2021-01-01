<?php

namespace DTL\ConsoleCanvas\Color;

use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\ColorCodes;

class SymfonyConsoleCodes implements ColorCodes
{
    public function render(Color $color): string
    {
        if (Color::none() == $color) {
            return '</>';
        }

        return sprintf('<fg=%s>', $color->__toString());
    }
}
