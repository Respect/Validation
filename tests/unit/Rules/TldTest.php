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
 *
 * @covers \Respect\Validation\Rules\Tld
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class TldTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, 'br'],
            [$rule, 'cafe'],
            [$rule, 'com'],
            [$rule, 'democrat'],
            [$rule, 'eu'],
            [$rule, 'gmbh'],
            [$rule, 'us'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new Tld();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, 'wrongtld'],
            [$rule, true],
        ];
    }
}
