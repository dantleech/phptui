<?php

namespace DTL\ConsoleCanvas\Color;

use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\ColorCodes;
use RuntimeException;

final class AnsiCodes implements ColorCodes
{
    private array $color = [
        Color::BLACK => '30',
        Color::RED => '31',
        Color::GREEN => '32',
        Color::YELLOW => '33',
        Color::BLUE => '34',
        Color::MAGENTA => '35',
        Color::CYAN => '36',
        Color::WHITE => '37',
    ];

    public function render(Color $color): string
    {
        if (array_key_exists($color->__toString(), $this->color)) {
            $code =$this->color[$color->__toString()];
            return "\x1b[" . $code . ";1m";
        }

        if (Color::none() == $color) {
            return "\x1b[0m";
        }

        throw new RuntimeException(sprintf(
            'Unknown color "%s"', $color->__toString()
        ));
    }

    public function reset(): string
    {
        return "\x1b[0m";
    }
}
