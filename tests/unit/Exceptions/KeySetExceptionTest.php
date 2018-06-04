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

use Respect\Validation\Exceptions\KeySetException;
use PHPUnit\Framework\TestCase;

class KeySetExceptionTest extends TestCase
{
    public function testChooseTemplateWithNoKeysParam(): void
    {
        $keySetException = new KeySetException();
        $keySetException->setParams([]);

        self::assertSame(1, $keySetException->chooseTemplate());
    }
}
