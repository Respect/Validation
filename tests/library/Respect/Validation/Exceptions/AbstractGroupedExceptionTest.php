<?php
namespace Respect\Validation\Exceptions;

class AbstractGroupedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testOneOrMoreGroupedExceptionsShouldBeCondensedByGetRelated()
    {
        $int =new IntException();
        $e = new AbstractGroupedException;
        $e2 = new AbstractNestedException;
        $e->addRelated($e2);
        $e2->addRelated($int);
        $result = $e->getRelated();
        $this->assertSame($int, current($result));
    }
}

