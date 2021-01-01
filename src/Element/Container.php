<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Container implements Element
{
    /**
     * @var array<string, array{Position,Element}>
     */
    private $elements = [];

    public function __construct(private int $width, private int $height)
    {
    }

    public function addAt(Position $position, Element $element): void
    {
        $this->elements[spl_object_hash($element)] = [$position, $element ];
    }

    public function render(Buffer $buffer): void
    {
        foreach ($this->elements as [$position, $element]) {
            assert($element instanceof ElementMetadata);
            $childCanvas = new Buffer($this->width, $this->height);

            $element->render($childCanvas);

            $buffer->merge($position, $childCanvas);
        }
    }
}
