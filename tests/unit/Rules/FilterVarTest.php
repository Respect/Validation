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
use const FILTER_FLAG_QUERY_REQUIRED;
use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_URL;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\FilterVar
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FilterVarTest extends RuleTestCase
{
    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot accept the given filter
     */
    public function itShouldThrowsExceptionWhenFilterIsNotValid(): void
    {
        new FilterVar(FILTER_SANITIZE_EMAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), '12345'],
            [new FilterVar(FILTER_VALIDATE_EMAIL), 'example@example.com'],
            [new FilterVar(FILTER_VALIDATE_FLOAT), 1.5],
            [new FilterVar(FILTER_VALIDATE_BOOLEAN), 'On'],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com?foo=bar'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), 1.4],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com'],
        ];
    }
}
