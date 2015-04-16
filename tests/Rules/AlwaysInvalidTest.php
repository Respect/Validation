<?php
namespace Respect\Validation\Rules;


use Respect\Validation\Exceptions\AlwaysInvalidException;

class AlwaysInvalidTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \Respect\Validation\Exceptions\AlwaysInvalidException
     */
    public function testAssertShouldThrowExceptionForEmptyInput() {
        $validator = new AlwaysInvalid();

        $validator->assert('');
    }
}
