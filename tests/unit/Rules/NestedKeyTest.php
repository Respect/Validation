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

use Respect\Validation\Validator;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\NestedKey
 * @covers Respect\Validation\Exceptions\NestedKeyException
 */
class NestedKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayWithPresentKeysWillReturnTrue()
    {
        $validator = new NestedKey('bar.foo.baz');
        $obj = array(
            'bar' => array (
                'foo' => array (
                    'baz' => 'hello world!',
                ),
            ),
        );
        $validator->assert($obj);
    }
}
