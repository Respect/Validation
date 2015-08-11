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

class AbstractGroupedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testOneOrMoreGroupedExceptionsShouldBeCondensedByGetRelated()
    {
        $int = new IntException();
        $e = new AbstractGroupedException();
        $e2 = new AbstractNestedException();
        $e->addRelated($e2);
        $e2->addRelated($int);
        $result = $e->getRelated();
        $this->assertSame($int, current($result));
    }
}
