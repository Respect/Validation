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

    public function testFindRelatedShouldFindCompositeExceptions(): void
    {
        $foo = new AttributeException();
        $bar = new AttributeException();
        $baz = new AttributeException();
        $bat = new AttributeException();
        $foo->configure('foo');
        $bar->configure('bar');
        $baz->configure('baz');
        $bat->configure('bat');
        $foo->addRelated($bar);
        $bar->addRelated($baz);
        $baz->addRelated($bat);
        self::assertSame($bar, $foo->findRelated('bar'));
        self::assertSame($baz, $foo->findRelated('baz'));
        self::assertSame($baz, $foo->findRelated('bar.baz'));
        self::assertSame($baz, $foo->findRelated('baz'));
        self::assertSame($bat, $foo->findRelated('bar.bat'));
        self::assertNull($foo->findRelated('none'));
        self::assertNull($foo->findRelated('bar.none'));
    }
}
