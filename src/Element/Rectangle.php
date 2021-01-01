<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Brush\BlockBrush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Style;

final class Rectangle implements Element
{
    public Brush $brush;

    public function __construct(
        public int $width,
        public int $height,
        ?Brush $brush = null,
        private ?Brush $fillBrush = null,
        private ?Style $fillStyle = null,
    )
    {
        $this->brush = $brush ?: new BlockBrush();
    }

    public function render(Buffer $buffer): void
    {
        //$this->renderFill($buffer);
        $this->renderStroke($buffer);
        //$this->renderCorners($buffer);
    }

    private function renderStroke(Buffer $buffer): void
    {
        $path = new Path(new Positions([
            new Position(0, 0),
            new Position(0, $this->height),
        ]), brush: $this->brush);
        $path->render($buffer);
    }

    private function renderFill(Buffer $buffer): void
    {
        if (null === $this->fillBrush) {
            return;
        }

        if ($this->height < 2) {
            return;
        }

        for ($y = 1; $y < $this->height; $y++) {
            $line = new Line(
                new Position(0, $y),
                new Position($this->width - 1, $y),
                brush: $this->fillBrush,
                style: $this->fillStyle
            );
            $line->render($buffer);
        }
    }

    private function renderCorners(Buffer $buffer): void
    {
        $angle = 45;

        foreach ([
            new Position(0, 0),
            new Position(0, $this->height),
            new Position($this->width, $this->height),
            new Position($this->width, 0),
        ] as $index => $position) {
        
            $buffer->print($position, $this->brush->stroke(new Stroke(angle: $angle, intersection: true)));
        
            // rotate 90 degrees to next corner
            $angle = abs($angle + 90) % 360;
        }
    }
}
