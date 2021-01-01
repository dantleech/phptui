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

    public function rowRanges(): PositionRanges
    {
        $rows = [];
        foreach ($this->positions as $position) {
            if (!isset($rows[(int)$position->y()])) {
                $rows[$position->y()] = [];
            }
            $rows[$position->y()][] = $position->x();
        }

        $rows = array_map(function (array $series) {
            sort($series);
            return $series;
        }, $rows);

        $ranges = array_map(function (array $row, int $y) {
            assert(!empty($row));
            return new PositionRange(
                new Position($row[array_key_first($row)], $y),
                new Position($row[array_key_last($row)], $y),
            );
        }, $rows, array_keys($rows));

        return new PositionRanges($ranges);

    }

    public function getIterator()
    {
        return new ArrayIterator($this->positions);
    }
}
