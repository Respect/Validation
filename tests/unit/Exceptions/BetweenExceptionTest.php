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

use Respect\Validation\Exceptions\BetweenException;
use PHPUnit\Framework\TestCase;

class BetweenExceptionTest extends TestCase
{
    public function testChooseTemplateWithMaxValueParam(): void
    {
        $betweenException = new BetweenException();
        $betweenException->setParams(['minValue' => 2]);

        self::assertSame(1, $betweenException->chooseTemplate());
    }
}
