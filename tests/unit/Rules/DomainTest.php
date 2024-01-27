<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\ToStringStub;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Domain
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mehmet Tolga Avcioglu <mehmet@activecom.net>
 */
final class DomainTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Domain(false), '111111111111domain.local'],
            [new Domain(false), '111111111111.domain.local'],
            [new Domain(), 'example.com'],
            [new Domain(), 'xn--bcher-kva.ch'],
            [new Domain(), 'mail.xn--bcher-kva.ch'],
            [new Domain(), 'example-hyphen.com'],
            [new Domain(), 'example--valid.com'],
            [new Domain(), 'std--a.com'],
            [new Domain(), 'r--w.com'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Domain(), null],
            [new Domain(), new stdClass()],
            [new Domain(), []],
            [new Domain(), new ToStringStub('google.com')],
            [new Domain(), ''],
            [new Domain(), 'no dots'],
            [new Domain(), '2222222domain.local'],
            [new Domain(), '-example-invalid.com'],
            [new Domain(), 'example.invalid.-com'],
            [new Domain(), 'xn--bcher--kva.ch'],
            [new Domain(), 'example.invalid-.com'],
            [new Domain(), '1.2.3.256'],
            [new Domain(), '1.2.3.4'],
        ];
    }
}
