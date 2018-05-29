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
 * @covers \Respect\Validation\Rules\Even
 * @covers \Respect\Validation\Exceptions\EvenException
 *
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul karikari <paulkarikari1@gmail.com>
 */
class EvenTest extends RuleTestCase
{
    /**
     * @dataProvider providerForInvalidInput
     * @expectedException \Respect\Validation\Exceptions\EvenException
     */
    public function testNotEvenNumbersShouldThrowException($validator, $input): void
    {
        $validator->assert($input);
    }

    public function providerForValidInput(): array
    {
        return [
            [new Even(), ''],
            [new Even(), -2],
            [new Even(), -0],
            [new Even(), 0],
            [new Even(), 32],
        ];
    }

    public function providerForInvalidInput(): array
    {
        return [
            [new Even(), -5],
            [new Even(), -1],
            [new Even(), 1],
            [new Even(), 13],
        ];
    }
}
