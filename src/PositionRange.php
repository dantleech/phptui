<?php

namespace DTL\ConsoleCanvas;

class PositionRange
{
    public function __construct(private Position $start, private Position $end)
    {
    }

    public function start(): Position
    {
        return $this->start;
    }

    public function end(): Position
    {
        return $this->end;
    }
}
