<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Stroke;

final class Rectangle implements Element
{
    private Brush $brush;
    private Brush $fillBrush;

    public function __construct(
        private float $width,
        private float $height,
        private bool $fill = false,
        ?Brush $brush = null,
        ?Brush $fillBrush = null,
    )
    {
        $this->brush = $brush ?: new BlockBrush();
        $this->fillBrush = $fillBrush ?: new BlockBrush();
    }

    public function render(Buffer $buffer): void
    {
        $this->renderStroke($buffer);
        $this->renderFill($buffer);
        $this->renderCorners($buffer);
    }

    private function renderStroke(Buffer $buffer): void
    {
        $path = new Path(new Positions([
            new Position(0, 0),
            new Position(0, $this->height),
            new Position($this->width, $this->height),
            new Position($this->width, 0),
            new Position(0, 0),
        ]), brush: $this->brush);
        $path->render($buffer);
    }

    private function renderFill(Buffer $buffer): void
    {
        if (!$this->fill) {
            return;
        }

        if ($this->height < 2) {
            return;
        }

        for ($y = 1; $y < $this->height; $y++) {
            $line = new Line(
                new Position(1, $y),
                new Position($this->width - 1, $y),
                brush: $this->fillBrush,
            );
            $line->render($buffer);
        }
    }

    private function renderCorners(Buffer $buffer): void
    {
        $angle = 135; // corner direction south-east

        foreach ([
            new Position(0, 0),
            new Position(0, $this->height),
            new Position($this->width, $this->height),
            new Position($this->width, 0),
        ] as $index => $position) {
        
            $buffer->print($position, $this->brush->stroke(new Stroke(angle: $angle, intersection: true)));
        
            // rotate 90 degrees to next corner
            $angle = abs($angle + 270) % 360;
        }
    }
}
