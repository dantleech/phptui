<?php

namespace DTL\ConsoleCanvas;

use RuntimeException;
use Stringable;

class Rune implements Stringable
{
    public function __construct(private string $rune)
    {
        if (mb_strlen($rune) !== 1) {
            throw new RuntimeException(sprintf(
                'Rune can only be a single unicode character, got "%s"',
                $rune
            ));
        }
    }

    public function __toString(): string
    {
        return $this->rune;
    }
}
