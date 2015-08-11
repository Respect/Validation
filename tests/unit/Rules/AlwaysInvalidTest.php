<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class AlwaysInvalidTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\AlwaysInvalidException
     */
    public function testAssertShouldThrowExceptionForEmptyInput()
    {
        $validator = new AlwaysInvalid();

        $validator->assert('');
    }
}
