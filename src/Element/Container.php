<?php

namespace DTL\ConsoleCanvas\Element;

use Closure;
use DTL\ConsoleCanvas\Buffer;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;
use RuntimeException;

final class Container implements Element
{
    /**
     * @var array<string, array{Position,Element}>
     */
    public $elements = [];

    public function __construct(public int $width, public int $height)
    {
    }

    public function place(Position $position, Element $element): void
    {
        $this->elements[spl_object_hash($element)] = [$position, $element ];
    }

    public function render(Buffer $buffer): void
    {
        foreach ($this->elements as [$position, $element]) {
            $childCanvas = new Buffer($this->width, $this->height);
            $element->render($childCanvas);
            $buffer->merge($position, $childCanvas);
        }
    }

    public function updateClass(string $className, Closure $closure): void
    {
        foreach ($this->elements as [$position, $element]) {
            if ($element instanceof $className) {
                $closure($element);
            }
        }
    }

    /**
     * @param Closure(Position): Position $closure
     */
    public function move(Element $element, Closure $closure): void
    {
        $this->elements[spl_object_hash($element)] = [ $closure($this->getPosition($element)), $element ];
    }

    private function getPosition(Element $element): Position
    {
        $hash = spl_object_hash($element);
        if (array_key_exists($hash, $this->elements)) {
            return $this->elements[$hash][0];
        }

        throw new RuntimeException(sprintf(
            'Element "%s" not found', $hash
        ));
    }

    public static function fromBuffer(Buffer $buffer): self
    {
        return new self($buffer->width(), $buffer->height());
    }
}
