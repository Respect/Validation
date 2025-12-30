<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;
use stdClass;

#[Group('rule')]
#[CoversClass(Executable::class)]
final class ExecutableTest extends RuleTestCase
{
    /** @return iterable<array{Executable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Executable();

        return [
            [$rule, 'tests/fixtures/executable'],
            [$rule, new SplFileInfo('tests/fixtures/executable')],
            [$rule, new SplFileObject('tests/fixtures/executable')],
        ];
    }

    /** @return iterable<array{Executable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Executable();

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, 'tests/fixtures/valid-image.gif'],
            [$rule, new SplFileInfo('tests/fixtures/valid-image.jpg')],
            [$rule, new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }
}
