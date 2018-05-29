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
 * @covers \Respect\Validation\Rules\Even
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Paul karikari <paulkarikari1@gmail.com>
 */
final class EvenTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        return [
            [new Even(), -2],
            [new Even(), -0],
            [new Even(), 0],
            [new Even(), 32],
        ];
    }

    public function providerForInvalidInput(): array
    {
        return [
            [new Even(), ''],
            [new Even(), -5],
            [new Even(), -1],
            [new Even(), 1],
            [new Even(), 13],
        ];
    }
}
