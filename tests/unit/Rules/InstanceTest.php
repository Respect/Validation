<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use ArrayObject;
use DateTime;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use stdClass;
use Traversable;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Instance
 */
final class InstanceTest extends RuleTestCase
{
    /**
     * @return array<array{Instance, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Instance(DateTime::class), new DateTime()],
            [new Instance(Traversable::class), new ArrayObject()],
            [new Instance(ArrayIterator::class), new ArrayIterator()],
        ];
    }

    /**
     * @return array<array{Instance, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Instance(DateTime::class), ''],
            [new Instance(Traversable::class), null],
            [new Instance(SplFileInfo::class), new stdClass()],
        ];
    }
}
