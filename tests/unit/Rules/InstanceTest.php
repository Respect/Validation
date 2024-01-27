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
 *
 * @covers \Respect\Validation\Rules\Instance
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class InstanceTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
