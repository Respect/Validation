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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Phone
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Firsikov <michael.firsikov@gmail.com>
 * @author Roman Derevianko <roman.derevianko@gmail.com>
 */
final class PhoneTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Phone();

        return [
            [$sut, '+5-555-555-5555'],
            [$sut, '+5 555 555 5555'],
            [$sut, '+5.555.555.5555'],
            [$sut, '5-555-555-5555'],
            [$sut, '5.555.555.5555'],
            [$sut, '5 555 555 5555'],
            [$sut, '555.555.5555'],
            [$sut, '555 555 5555'],
            [$sut, '555-555-5555'],
            [$sut, '555-5555555'],
            [$sut, '5(555)555.5555'],
            [$sut, '+5(555)555.5555'],
            [$sut, '+5(555)555 5555'],
            [$sut, '+5(555)555-5555'],
            [$sut, '+5(555)5555555'],
            [$sut, '(555)5555555'],
            [$sut, '(555)555.5555'],
            [$sut, '(555)555-5555'],
            [$sut, '(555) 555 5555'],
            [$sut, '55555555555'],
            [$sut, '5555555555'],
            [$sut, '+33(1)2222222'],
            [$sut, '+33(1)222 2222'],
            [$sut, '+33(1)222.2222'],
            [$sut, '+33(1)22 22 22 22'],
            [$sut, '33(1)2222222'],
            [$sut, '33(1)22222222'],
            [$sut, '33(1)22 22 22 22'],
            [$sut, '(020) 7476 4026'],
            [$sut, '33(020) 7777 7777'],
            [$sut, '33(020)7777 7777'],
            [$sut, '+33(020) 7777 7777'],
            [$sut, '+33(020)7777 7777'],
            [$sut, '03-6106666'],
            [$sut, '036106666'],
            [$sut, '+33(11) 97777 7777'],
            [$sut, '+3311977777777'],
            [$sut, '11977777777'],
            [$sut, '11 97777 7777'],
            [$sut, '(11) 97777 7777'],
            [$sut, '(11) 97777-7777'],
            [$sut, '555-5555'],
            [$sut, '5555555'],
            [$sut, '555.5555'],
            [$sut, '555 5555'],
            [$sut, '+1 (555) 555 5555'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Phone();

        return [
            [$sut, ''],
            [$sut, '123'],
            [$sut, '(11- 97777-7777'],
            [$sut, '-11) 97777-7777'],
            [$sut, 's555-5555'],
            [$sut, '555-555'],
            [$sut, '555555'],
            [$sut, '555+5555'],
            [$sut, '(555)555555'],
            [$sut, '(555)55555'],
            [$sut, '+(555)555 555'],
            [$sut, '+5(555)555 555'],
            [$sut, '+5(555)555 555 555'],
            [$sut, '555)555 555'],
            [$sut, '+5(555)5555 555'],
            [$sut, '(555)55 555'],
            [$sut, '(555)5555 555'],
            [$sut, '+5(555)555555'],
            [$sut, '5(555)55 55555'],
            [$sut, '(5)555555'],
            [$sut, '+55(5)55 5 55 55'],
            [$sut, '+55(5)55 55 55 5'],
            [$sut, '+55(5)55 55 55'],
            [$sut, '+55(5)5555 555'],
            [$sut, '+55()555 5555'],
            [$sut, '03610666-5'],
            [$sut, 'text'],
            [$sut, "555\n5555"],
            [$sut, []],
        ];
    }
}
