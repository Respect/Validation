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

use function chr;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Printable
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PrintableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Printable();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'foo' . chr(7) . 'bar'],
            [$rule, 'foo' . chr(10) . 'bar'],
        ];
    }
}
