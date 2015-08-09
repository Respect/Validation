<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

/**
 * phpunit has an issue with mocking exceptions when in HHVM:
 * https://github.com/sebastianbergmann/phpunit-mock-objects/issues/207
 */
class PrivateAbstractNestedException extends AbstractNestedException
{
}

class AbstractNestedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testItImplementsNestedValidationExceptionInterface()
    {
        $abstractNestedException = new PrivateAbstractNestedException();
        $this->assertInstanceOf('Respect\Validation\Exceptions\NestedValidationExceptionInterface',
            $abstractNestedException);
    }

    public function testGetRelatedShouldReturnExceptionAddedByAddRelated()
    {
        $composite = new AttributeException();
        $node = new IntException();
        $composite->addRelated($node);
        $this->assertEquals(1, count($composite->getRelated(true)));
        $this->assertContainsOnly($node, $composite->getRelated());
    }

    public function testAddingTheSameInstanceShouldAddJustASingleReference()
    {
        $composite = new AttributeException();
        $node = new IntException();
        $composite->addRelated($node);
        $composite->addRelated($node);
        $composite->addRelated($node);
        $this->assertEquals(1, count($composite->getRelated(true)));
        $this->assertContainsOnly($node, $composite->getRelated());
    }

    public function testFindRelatedShouldFindCompositeExceptions()
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
        $this->assertSame($bar, $foo->findRelated('bar'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($baz, $foo->findRelated('bar.baz'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($bat, $foo->findRelated('bar.bat'));
        $this->assertSame(false, $foo->findRelated('none'));
        $this->assertSame(false, $foo->findRelated('bar.none'));
    }
}
