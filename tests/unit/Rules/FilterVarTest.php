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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

use const FILTER_FLAG_HOSTNAME;
use const FILTER_FLAG_QUERY_REQUIRED;
use const FILTER_SANITIZE_EMAIL;
use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_URL;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractEnvelope
 * @covers \Respect\Validation\Rules\FilterVar
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FilterVarTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldThrowsExceptionWhenFilterIsNotValid(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Cannot accept the given filter');

        new FilterVar(FILTER_SANITIZE_EMAIL);
    }

    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), '12345'],
            [new FilterVar(FILTER_VALIDATE_EMAIL), 'example@example.com'],
            [new FilterVar(FILTER_VALIDATE_FLOAT), 1.5],
            [new FilterVar(FILTER_VALIDATE_BOOLEAN), 'On'],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com?foo=bar'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN), 'example.com'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), 1.4],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN), '.com'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME), '@local'],
        ];
    }
}
