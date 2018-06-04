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

use Respect\Validation\Exceptions\RecursiveExceptionIterator;
use Respect\Validation\Exceptions\NestedValidationException;
use PHPUnit\Framework\TestCase;

class RecursiveExceptionIteratorTest extends TestCase
{
    public function testHasChildenWithInvalidIterator(): void
    {
        $recursiveExceptionIterator = new RecursiveExceptionIterator(new NestedValidationException());

        self::assertFalse($recursiveExceptionIterator->hasChildren());
    }

    public function testKey(): void
    {
        $recursiveExceptionIterator = new RecursiveExceptionIterator(new NestedValidationException());

        self::assertSame(0, $recursiveExceptionIterator->key());    
    }
}
