<?php

namespace DTL\ConsoleCanvas;

use ArrayIterator;
use IteratorAggregate;

class Positions implements IteratorAggregate
{
    public function __construct(private array $positions)
    {
    }

    public static function fromPairs(array $pairs): self
    {
        return new self(array_map(function (array $pair) {
            return new Position($pair[0], $pair[1]);
        }, $pairs));
    }

    public function getIterator()
    {
        return new ArrayIterator($this->positions);
    }
}
