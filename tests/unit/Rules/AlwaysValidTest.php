<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group(' rule')]
#[CoversClass(AlwaysValid::class)]
final class AlwaysValidTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForValidInput')]
    public function itAlwaysBeValid(mixed $input): void
    {
        $rule = new AlwaysValid();

        self::assertTrue($rule->evaluate($input)->hasPassed);
    }

    /** @return mixed[][] */
    public static function providerForValidInput(): iterable
    {
        return [
            [0],
            [1],
            ['string'],
            [true],
            [false],
            [null],
            [''],
            [[]],
            [['array_full']],
        ];
    }
}
