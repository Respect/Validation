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

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\TestCase;

/**
 * phpunit has an issue with mocking exceptions when in HHVM:
 * https://github.com/sebastianbergmann/phpunit-mock-objects/issues/207.
 */
class PrivateNestedValidationException extends NestedValidationException
{
}

class NestedValidationExceptionTest extends TestCase
{
    public function testGetRelatedShouldReturnExceptionAddedByAddRelated(): void
    {
        $composite = new AttributeException();
        $node = new IntValException();
        $composite->addRelated($node);
        self::assertEquals(1, count($composite->getRelated(true)));
        self::assertContainsOnly($node, $composite->getRelated());
    }

    public function testAddingTheSameInstanceShouldAddJustASingleReference(): void
    {
        $composite = new AttributeException();
        $node = new IntValException();
        $composite->addRelated($node);
        $composite->addRelated($node);
        $composite->addRelated($node);
        self::assertEquals(1, count($composite->getRelated(true)));
        self::assertContainsOnly($node, $composite->getRelated());
    }
}
