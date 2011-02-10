<?php

namespace Respect\Validation;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

class CombinedMessagesTest extends \PHPUnit_Framework_TestCase
{

    public function testIntPositiveBetween()
    {
        $int = v::int()->positive()->between(0, 256)->setName('Meu Campo');
        try {
            $int->assert(null);
        } catch (ValidationException $e) {
            //echo $e->getFullMessage() . PHP_EOL;
        }
    }

    public function testScreenName()
    {
        $int = v::alnum('_')->noWhitespace()->length(1, 15);
        try {
            $int->assert(null);
        } catch (ValidationException $e) {
            //echo $e->getFullMessage() . PHP_EOL;
        }
    }

}
