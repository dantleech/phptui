<?php

namespace DTL\ConsoleCanvas;

final class Stroke
{
    public function __construct(
        private float $angle = 0,
        private bool $intersection = false
    )
    {
    }

    public function angle(): float
    {
        return $this->angle;
    }

    public function intersection(): bool
    {
        return $this->intersection;
    }
}
