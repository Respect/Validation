<?php

namespace Respect\Validation\Exceptions;


class AbstractGroupedExceptionTest extends \PHPUnit_Framework_TestCase
{
    function test_one_or_more_grouped_exceptions_should_be_condensed_by_getRelated()
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