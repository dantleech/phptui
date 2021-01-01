<?php

namespace DTL\ConsoleCanvas;

final class Position
{
    public function __construct(private float $x, private float $y)
    {
    }

    public function withX(float $x): self
    {
        return new self($x, $this->y);
    }

    public function withY(float $y): self
    {
        return new self($this->x, $y);
    }

    public function x(): float
    {
        return $this->x;
    }

    public function y(): float
    {
        return $this->y;
    }
}
