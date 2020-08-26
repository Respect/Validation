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

use DateTime;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractEnvelope
 * @covers \Respect\Validation\Rules\Between
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BetweenTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Between(0, 1), 1],
            [new Between(0, 1), 0],
            [new Between(10, 20), 15],
            [new Between(10, 20), 20],
            [new Between(-10, 20), -5],
            [new Between(-10, 20), 0],
            [new Between('a', 'z'), 'j'],
            [new Between(new DateTime('yesterday'), new DateTime('tomorrow')), new DateTime('now')],
            [new Between(new CountableStub(1), new CountableStub(10)), 5],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Between(10, 20), ''],
            [new Between(10, 20), ''],
            [new Between(0, 1), 2],
            [new Between(0, 1), -1],
            [new Between(10, 20), 999],
            [new Between(-10, 20), -11],
            [new Between('a', 'j'), 'z'],
            [new Between(new DateTime('yesterday'), new DateTime('now')), new DateTime('tomorrow')],
            [new Between(new CountableStub(1), new CountableStub(10)), 11],
        ];
    }

    /**
     * @test
     */
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new Between(10, 5);
    }

    /**
     * @test
     */
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        $this->expectExceptionObject(new ComponentException('Minimum cannot be less than or equals to maximum'));

        new Between(5, 5);
    }
}
