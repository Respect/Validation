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
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Printable
 */
final class PrintableTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Printable();

        return [
            [$rule, ' '],
            [$rule, 'LKA#@%.54'],
            [$rule, 'foobar'],
            [$rule, '16-50'],
            [$rule, '123'],
            [$rule, 'foo bar'],
            [$rule, '#$%&*_'],
            [new Printable("\t\n"), "\t\n "],
            [new Printable("\v\r"), "\v\r "],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Printable();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'foo'.chr(7).'bar'],
            [$rule, 'foo'.chr(10).'bar'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidParams
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        (new Printable($additional));
    }

    public function providerForInvalidParams(): array
    {
        return [
            [new \stdClass()],
            [[]],
            [0x2],
        ];
    }
}
