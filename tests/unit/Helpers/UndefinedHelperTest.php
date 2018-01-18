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

namespace Respect\Validation\Test\Helpers;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Helpers\UndefinedHelper;
use Respect\Validation\Test\DataProvider\UndefinedProvider;

/**
 * @group helper
 *
 * @covers \Respect\Validation\Helpers\UndefinedHelper
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class UndefinedHelperTest extends TestCase
{
    use UndefinedHelper,
        UndefinedProvider;

    /**
     * @test
     * @dataProvider providerForUndefined
     *
     * @param mixed $value
     */
    public function shouldFindWhenValueIsUndefined($value): void
    {
        self::assertTrue($this->isUndefined($value));
    }

    /**
     * @test
     * @dataProvider providerForNotUndefined
     *
     * @param mixed $value
     */
    public function shouldFindWhenValueIsNotUndefined($value): void
    {
        self::assertFalse($this->isUndefined($value));
    }
}
