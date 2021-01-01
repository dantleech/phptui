<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush\Char;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Rune;

final class Text implements Element
{
    public function __construct(private string $text)
    {
    }

    public function render(Buffer $buffer): void
    {
        foreach (mb_str_split($this->text) as $x => $char) {
            $buffer->print(new Position(x: $x, y: 0), new Rune($char));
        }
    }
}
