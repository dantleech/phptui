<?php

namespace DTL\ConsoleCanvas;

use Stringable;

final class Color implements Stringable
{
    public const BLACK = 'black';
    public const RED = 'red';
    public const GREEN = 'green';
    public const YELLOW = 'yellow';
    public const BLUE = 'blue';
    public const MAGENTA = 'magenta';
    public const CYAN = 'cyan';
    public const WHITE = 'white';

    public function __construct(private string $color)
    {
    }

    public static function black(): self
    {
        return new self(self::BLACK);
    }

    public static function red(): self
    {
        return new self(self::RED);
    }

    public static function green(): self
    {
        return new self(self::GREEN);
    }

    public static function yellow(): self
    {
        return new self(self::YELLOW);
    }

    public static function blue(): self
    {
        return new self(self::BLUE);
    }

    public static function magenta(): self
    {
        return new self(self::MAGENTA);
    }

    public static function cyan(): self
    {
        return new self(self::CYAN);
    }

    public static function white(): self
    {
        return new self(self::WHITE);
    }

    public static function none(): self
    {
        return new self('');
    }

    public function __toString(): string
    {
        return $this->color;
    }
}
