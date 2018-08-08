<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
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
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class InstanceTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Instance(DateTime::class), new DateTime()],
            [new Instance(Traversable::class), new ArrayObject()],
            [new Instance(ArrayIterator::class), new ArrayIterator()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Instance(DateTime::class), ''],
            [new Instance(Traversable::class), null],
            [new Instance(SplFileInfo::class), new stdClass()],
        ];
    }
}
