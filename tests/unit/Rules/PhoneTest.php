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
 * @covers \Respect\Validation\Rules\Phone
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Firsikov <michael.firsikov@gmail.com>
 */
final class PhoneTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $phone = new Phone();

        return [
            [$phone, '+5-555-555-5555'],
            [$phone, '+5 555 555 5555'],
            [$phone, '+5.555.555.5555'],
            [$phone, '5-555-555-5555'],
            [$phone, '5.555.555.5555'],
            [$phone, '5 555 555 5555'],
            [$phone, '555.555.5555'],
            [$phone, '555 555 5555'],
            [$phone, '555-555-5555'],
            [$phone, '555-5555555'],
            [$phone, '5(555)555.5555'],
            [$phone, '+5(555)555.5555'],
            [$phone, '+5(555)555 5555'],
            [$phone, '+5(555)555-5555'],
            [$phone, '+5(555)5555555'],
            [$phone, '(555)5555555'],
            [$phone, '(555)555.5555'],
            [$phone, '(555)555-5555'],
            [$phone, '(555) 555 5555'],
            [$phone, '55555555555'],
            [$phone, '5555555555'],
            [$phone, '+33(1)2222222'],
            [$phone, '+33(1)222 2222'],
            [$phone, '+33(1)222.2222'],
            [$phone, '+33(1)22 22 22 22'],
            [$phone, '33(1)2222222'],
            [$phone, '33(1)22222222'],
            [$phone, '33(1)22 22 22 22'],
            [$phone, '(020) 7476 4026'],
            [$phone, '33(020) 7777 7777'],
            [$phone, '33(020)7777 7777'],
            [$phone, '+33(020) 7777 7777'],
            [$phone, '+33(020)7777 7777'],
            [$phone, '03-6106666'],
            [$phone, '036106666'],
            [$phone, '+33(11) 97777 7777'],
            [$phone, '+3311977777777'],
            [$phone, '11977777777'],
            [$phone, '11 97777 7777'],
            [$phone, '(11) 97777 7777'],
            [$phone, '(11) 97777-7777'],
            [$phone, '555-5555'],
            [$phone, '5555555'],
            [$phone, '555.5555'],
            [$phone, '555 5555'],
            [$phone, '+1 (555) 555 5555'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $phone = new Phone();

        return [
            [$phone, ''],
            [$phone, '123'],
            [$phone, '(11- 97777-7777'],
            [$phone, '-11) 97777-7777'],
            [$phone, 's555-5555'],
            [$phone, '555-555'],
            [$phone, '555555'],
            [$phone, '555+5555'],
            [$phone, '(555)555555'],
            [$phone, '(555)55555'],
            [$phone, '+(555)555 555'],
            [$phone, '+5(555)555 555'],
            [$phone, '+5(555)555 555 555'],
            [$phone, '555)555 555'],
            [$phone, '+5(555)5555 555'],
            [$phone, '(555)55 555'],
            [$phone, '(555)5555 555'],
            [$phone, '+5(555)555555'],
            [$phone, '5(555)55 55555'],
            [$phone, '(5)555555'],
            [$phone, '+55(5)55 5 55 55'],
            [$phone, '+55(5)55 55 55 5'],
            [$phone, '+55(5)55 55 55'],
            [$phone, '+55(5)5555 555'],
            [$phone, '+55()555 5555'],
            [$phone, '03610666-5'],
            [$phone, 'text'],
            [$phone, "555\n5555"],
            [$phone, []],
        ];
    }
}
