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

namespace Respect\Validation\Test\Exceptions;

use Respect\Validation\Exceptions\NullableException;
use PHPUnit\Framework\TestCase;

class NullableExceptionTest extends TestCase
{
    public function testChooseTemplateWithHasName(): void
    {
        $nullableException = new NullableException();
        $nullableException->setName('name');

        self::assertSame(1, $nullableException->chooseTemplate());
    }

    public function testChooseTemplateWithHasNoName(): void
    {
        $nullableException = new nullableException();

        self::assertSame(0, $nullableException->chooseTemplate());
    }
}
