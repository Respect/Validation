<?php

namespace Respect\Validation\Exceptions;

class AbstractNestedExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testAddRelated()
    {
        $x = new AttributeException;
        $int = new IntException;
        $x->addRelated($int);
        $this->assertEquals(1, count($x->getRelated(true)));
    }

    public function testAddRelatedIdentity()
    {
        $x = new AttributeException;
        $int = new IntException;
        $x->addRelated($int);
        $x->addRelated($int);
        $x->addRelated($int);
        $this->assertEquals(1, count($x->getRelated(true)));
    }

    public function testFindRelated()
    {
        $foo = new AttributeException;
        $bar = new AttributeException;
        $baz = new AttributeException;
        $bat = new AttributeException;
        $foo->configure('foo');
        $bar->configure('bar');
        $baz->configure('baz');
        $bat->configure('bat');
        $foo->addRelated($bar);
        $bar->addRelated($baz);
        $baz->addRelated($bat);
        $this->assertSame($bar, $foo->findRelated('bar'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($baz, $foo->findRelated('bar', 'baz'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($bat, $foo->findRelated('bar', 'bat'));
        $this->assertSame(false, $foo->findRelated('none'));
        $this->assertSame(false, $foo->findRelated('bar', 'none'));
    }

}
