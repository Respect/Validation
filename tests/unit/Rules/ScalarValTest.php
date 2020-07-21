<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ScalarVal
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ScalarValTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new ScalarVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new ScalarVal();

        return [
            [$rule, []],
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}
