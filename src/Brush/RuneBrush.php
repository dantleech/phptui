<?php

namespace DTL\ConsoleCanvas\Brush;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Rune;
use DTL\ConsoleCanvas\Stroke;
use RuntimeException;

class RuneBrush implements Brush
{
    private int $counter = 0;

    /**
     * @param list<Rune> $runes
     */
    public function __construct(private array $runes)
    {
        if (count($runes) < 1) {
            throw new RuntimeException(sprintf(
                'Must have at least one rune got 0'
            ));
        }
    }

    public static function fromChar(string $char): self
    {
        return new self([new Rune($char)]);
    }

    public function stroke(Stroke $stroke): Rune
    {
        if (count($this->runes) === 1) {
            return $this->runes[0];
        }

        $rune = $this->runes[$this->counter++ % count($this->runes)];

        return $rune;
    }
}
