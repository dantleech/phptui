<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Color\AnsiCodes;

class Buffer
{
    /**
     * @var array<int, array<int, Cell>>
     */
    private $grid = [];

    private ColorCodes $colorCodes;

    public function __construct(
        private int $width,
        private int $height,
        ?ColorCodes $colorCodes = null
    )
    {
        
        $this->colorCodes = $colorCodes ?: new AnsiCodes();
    }

    public static function fromTextDimensions(string $expected, ?ColorCodes $colorCodes = null): self
    {
        $lines = explode("\n", $expected);
        $length = 0;
        foreach ($lines as $line) {
            if (($lineLength = mb_strlen($line)) > $length) {
                $length = $lineLength;
            }
        }

        return new self($length, count($lines), $colorCodes);
    }

    public function print(Position $position, Rune $rune, ?Style $style = null): void
    {
        $this->putCell($position, new Cell($rune, $style ?? Style::none()));
    }

    public function render(): string
    {
        $output = [];
        $currentStyle = Color::none();
        $grid = $this->grid;

        for ($y = 0; $y < $this->height; $y++) {
            $line = '';

            for ($x = 0; $x < $this->width; $x++) {

                if (!isset($grid[$y][$x])) {
                    $line .= ' ';
                    continue;
                }
                $cell = $grid[$y][$x];

                if (null === $currentStyle || $cell->style()->fg() != $currentStyle) {
                    $currentStyle = $cell->style()->fg();
                    $line .= $this->colorCodes->render($currentStyle);
                }

                $line .= $cell->rune()->__toString();
            }

            $output[] = $line;
        }

        if ($currentStyle != Color::none() && count($output) > 0) {
            $output[array_key_last($output)] = $output[array_key_last($output)] . $this->colorCodes->render(Color::none());
        }

        return implode("\n", $output);
    }

    public function clear(): void
    {
        $this->grid = [];
    }

    private function putCell(Position $position, Cell $cell): void
    {
        if ($position->x() > $this->width) {
            return;
        }

        if ($position->y() > $this->height) {
            return;
        }

        $this->grid[(int)round($position->y())][(int)round($position->x())] = $cell;
    }

    public function merge(Position $position, Buffer $buffer): void
    {
        foreach ($buffer->grid as $y => $row) {
            foreach ($row as $x => $cell) {
                $this->putCell(
                    $position->withX($position->x() + $x)->withY($position->y() + $y),
                    $cell
                );
            }
        }
    }
}
