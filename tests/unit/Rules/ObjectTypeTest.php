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

use ArrayObject;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ObjectType
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ObjectTypeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new ObjectType();

        return [
            [$rule, new stdClass()],
            [$rule, new ArrayObject()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new ObjectType();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, []],
            [$rule, 'Foo'],
            [$rule, false],
        ];
    }
}
