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
use SimpleXMLElement;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ArrayVal
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
class ArrayValTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new ArrayVal();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, new ArrayObject()],
            [$rule, new SimpleXMLElement('<foo></foo>')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new ArrayVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, new stdClass()],
            [$rule, false],
            [$rule, 'aaa'],
        ];
    }
}
