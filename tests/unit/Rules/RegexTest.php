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

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Regex
 */
final class RegexTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Regex('/^[a-z]+$/'), 'wpoiur'],
            [new Regex('/^[a-z]+$/i'), 'wPoiur'],
            [new Regex('/^[0-9]+$/i'), 42],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Regex('/^w+$/'), 'w poiur'],
            [new Regex('/^w+$/'), new \stdClass()],
            [new Regex('/^w+$/'), []],
        ];
    }
}
