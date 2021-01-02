<?php

namespace DTL\ConsoleCanvas;

use RuntimeException;


/**
 * Grid position.
 *
 * Cells are numbered from 1:
 *
 *    +---+---+---+---+
 *   4|   |   |   |   |
 *    +---+---+---+---+
 *   3|   |   |   |   |
 * Y  +---+---+---+---+
 *   2|   |   |   |   |
 *    +---+---+---+---+
 *   1|   |   |   |   |
 *    +---+---+---+---+
 *      1   2   3   4
 *            X
 */
final class Position
{
    public function __construct(private int $x, private int $y)
    {
        if ($x < 1) {
            throw new RuntimeException(sprintf(
                'Grid X position cannot be < 1, got %s',
                $x
            ));
        }

        if ($y < 1) {
            throw new RuntimeException(sprintf(
                'Grid Y position cannot be < 1, got %s',
                $y
            ));
        }
    }

    public static function fromFloat(float $x, float $y)
    {
        return new self((int)round($x), (int)round($y));
    }

    public function withX(int $x): self
    {
        return new self($x, $this->y);
    }

    public function withY(int $y): self
    {
        return new self($this->x, $y);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }
}
