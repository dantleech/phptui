<?php

namespace DTL\ConsoleCanvas\Tests\Unit;

use DTL\ConsoleCanvas\Buffer;
use PHPUnit\Framework\TestCase;

class BufferTest extends TestCase
{
    public function testSize(): void
    {
        $buffer = new Buffer(100, 100);
        $output = $buffer->render();
        $lines = explode("\n", $output);
        self::assertCount(100, $lines);

        foreach ($lines as $line) {
            self::assertEquals(100, mb_strlen($line));
        }
    }
}
