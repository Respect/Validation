<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Returns a test double for the specified class.
     *
     * This method is created to keep compatibility with PHPUnit ~4.0.
     *
     * @param string $originalClassName
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createMock($originalClassName)
    {
        if (!class_exists('PHPUnit_Framework_Constraint_IsFinite')) {
            return $this->getMockBuilder($originalClassName)
                ->disableOriginalConstructor()
                ->getMock();
        }

        return parent::createMock($originalClassName);
    }
}
