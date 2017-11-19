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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\FilterVar
 * @covers \Respect\Validation\Exceptions\FilterVarException
 */
class FilterVarTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate without filter flag
     */
    public function testShouldThrowsExceptionWhenFilterIsNotDefined(): void
    {
        new FilterVar();
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot accept the given filter
     */
    public function testShouldThrowsExceptionWhenFilterIsNotValid(): void
    {
        new FilterVar(FILTER_SANITIZE_EMAIL);
    }

    public function testShouldDefineFilterOnConstructor(): void
    {
        $rule = new FilterVar(FILTER_VALIDATE_REGEXP);

        $actualArguments = $rule->arguments;
        $expectedArguments = [FILTER_VALIDATE_REGEXP];

        self::assertEquals($expectedArguments, $actualArguments);
    }

    public function testShouldDefineFilterOptionsOnConstructor(): void
    {
        $rule = new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);

        $actualArguments = $rule->arguments;
        $expectedArguments = [FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED];

        self::assertEquals($expectedArguments, $actualArguments);
    }

    public function testShouldUseDefineFilterToValidate(): void
    {
        $rule = new FilterVar(FILTER_VALIDATE_EMAIL);

        self::assertTrue($rule->validate('henriquemoody@users.noreply.github.com'));
    }

    public function testShouldUseDefineFilterOptionsToValidate(): void
    {
        $rule = new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED);

        self::assertTrue($rule->validate('http://example.com?foo=bar'));
    }
}
