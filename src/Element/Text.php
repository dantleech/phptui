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
    public function __construct(public string $text)
    {
    }

    public function render(Buffer $buffer): void
    {
        foreach (mb_str_split($this->text) as $x => $char) {
            $buffer->print(new Position(x: (int)$x + 1, y: 1), new Rune($char));
        }
    }
}
