<?php

namespace DTL\ConsoleCanvas\Tests\Unit;

use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\PositionRange;
use DTL\ConsoleCanvas\PositionRanges;
use DTL\ConsoleCanvas\Positions;
use PHPUnit\Framework\TestCase;

class PositionsTest extends TestCase
{
    public function testRowRanges(): void
    {
        $positions =  new Positions([
            new Position(3, 3),
            new Position(2, 3),
            new Position(4, 3),
            new Position(2, 1),
            new Position(4, 1),
        ]);
        self::assertEquals(
            new PositionRanges([
                new PositionRange(new Position(2, 3), new Position(4, 3)),
                new PositionRange(new Position(2, 1), new Position(4, 1)),
            ]),
            $positions->rowRanges()
        );
    }
}
