<?php

namespace DTL\ConsoleCanvas;

final class Position
{
    public function __construct(private int $x, private int $y)
    {
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
