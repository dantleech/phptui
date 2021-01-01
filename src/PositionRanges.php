<?php

namespace DTL\ConsoleCanvas;

use ArrayIterator;
use IteratorAggregate;

class PositionRanges implements IteratorAggregate
{
    /**
     * @param list<PositionRange> $positionRanges
     */
    public function __construct(private array $positionRanges)
    {
    }

    public function getIterator()
    {
        return new ArrayIterator($this->positionRanges);
    }

    public function fromY(int $y): self
    {
        return new self(array_values(array_filter(
            $this->positionRanges,
            static function (PositionRange $range) use ($y) {
                return $range->start()->y() >= $y;
            }
        )));
    }
}
