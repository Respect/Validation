<?php

namespace Respect\Validation;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

class NegativeTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Toggle this to show an example of all validation
     * messages on the PHPUnit console.
     */

    protected $showMessages = false;
    protected $targetName = 'My Field';

    protected function genMessage($validator, $invalidValue)
    {
        try {
            $validator->assert($invalidValue);
        } catch (ValidationException $e) {
            if ($this->showMessages)
                echo 'Default: ' . $e->getFullMessage() . PHP_EOL;
        }
        $validator->setName($this->targetName);
        try {
            $validator->assert($invalidValue);
        } catch (ValidationException $e) {
            if ($this->showMessages)
                echo 'Named:   ' . $e->getFullMessage() . PHP_EOL . PHP_EOL;
        }
    }

    public function testAlnum()
    {
        $this->genMessage(v::alnum(), '#');
        $this->genMessage(v::alnum('_'), '#');
    }

    public function testAlpha()
    {
        $this->genMessage(v::alpha(), '#');
        $this->genMessage(v::alpha('.'), '#');
    }

    public function testArr()
    {
        $this->genMessage(v::arr(), '#');
    }

    public function testAttribute()
    {
        $this->genMessage(v::attribute("foo", v::int()),
            (object) array("foo" => "bar"));
        $this->genMessage(v::attribute("foo", v::string()), null);
    }

    public function testBetween()
    {
        $this->genMessage(v::between(5, 15), 999);
        $this->genMessage(v::between('a', 'f'), 15951);
        $this->genMessage(v::between(new \DateTime('now'),
                new \DateTime('tomorrow')), new \DateTime('yesterday'));
    }

    public function testCall()
    {
        $this->genMessage(v::call('implode', v::int()), array('x', 2, 3, 4));
    }

    public function testCallback()
    {
        $this->genMessage(v::callback('is_string'), 123);
    }

    public function testDate()
    {
        $this->genMessage(v::date('Y-m-d'), '2010-30-10');
        $this->genMessage(v::date(), 'Jan 310 2008');
    }

    public function testDigits()
    {
        $this->genMessage(v::digits(), 'x02384');
    }

    public function testEach()
    {
        $this->genMessage(v::each(v::hexa()), array('AF', 'P1', '09'));
    }

    public function testEquals()
    {
        $this->genMessage(v::equals('foobar'), 'aaar');
    }

    public function testFloat()
    {
        $this->genMessage(v::float(), 'dance');
    }

    public function testHexa()
    {
        $this->genMessage(v::hexa(), 'PPAFAF');
    }

    public function testIn()
    {
        $this->genMessage(v::in(array(1, 1, 2, 3, 5, 8)), 9845984);
    }

    public function testInstance()
    {
        $this->genMessage(v::instance('\ss'), new \stdClass);
    }

    public function testInt()
    {
        $this->genMessage(v::int(), 15.48);
    }

    public function testIp()
    {
        $this->genMessage(v::ip(), '200.999.220.222');
    }

    public function testLength()
    {
        $this->genMessage(v::length(5, 10), 'foobarbalzobihbiy');
        $this->genMessage(v::length(2, 3), array(1, 2, 3, 4, 5));
        $this->genMessage(v::length(null, 3), array(1, 2, 3, 4, 5));
        $this->genMessage(v::length(15, null), array(1, 2, 3, 4, 5));
    }

    public function testMax()
    {
        $this->genMessage(v::max(5), 9854);
        $this->genMessage(v::max(5, true), 9854);
    }

    public function testMin()
    {
        $this->genMessage(v::min(5), -9514);
        $this->genMessage(v::min(5, true), -9514);
    }

    public function testNegative()
    {
        $this->genMessage(v::negative(), 5);
    }

    public function testPositive()
    {
        $this->genMessage(v::positive(), -3);
    }

    public function testNoWhitespace()
    {
        $this->genMessage(v::noWhitespace(), 'a bc');
    }

    public function testNotEmpty()
    {
        $this->genMessage(v::notEmpty(), '');
    }

    public function testNullValue()
    {
        $this->genMessage(v::nullValue(), true);
    }

    public function testNumeric()
    {
        $this->genMessage(v::numeric(), null);
    }

    public function testObject()
    {
        $this->genMessage(v::object(), null);
    }

    public function testRegex()
    {
        $this->genMessage(v::regex('^[a-f]+$'), 'abcdxxxef');
    }

    public function testString()
    {
        $this->genMessage(v::string(), null);
    }

    public function testAllOf()
    {
        $this->genMessage(v::allOf(
                v::string(), //any string 
                v::length(5, 20), //between 5 and 20 chars
                v::noWhitespace()   //no whitespace allowed
            ), "# #");

//same as

        $this->genMessage(v::string()
                ->length(5, 20)
                ->noWhitespace(), '# #');
    }

    public function testOneOf()
    {
        $v = v::oneOf(
                v::int()->positive(), //positive integer or;
                v::float()->negative(), //negative float or; 
                v::nullValue() //null
        );
        $this->genMessage($v, '');
        $this->genMessage($v, '');
        $this->genMessage($v, '');
    }

}
