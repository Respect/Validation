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

    protected function doTestValidator($validator, $invalidValue)
    {
        try {
            $validator->assert($invalidValue);
            $this->fail();
        } catch (ValidationException $e) {
            if ($this->showMessages)
                echo 'Default: ' . $e->getFullMessage() . PHP_EOL;
        }
        $validator->setName($this->targetName);
        try {
            $validator->assert($invalidValue);
            $this->fail();
        } catch (ValidationException $e) {
            if ($this->showMessages)
                echo 'Named:   ' . $e->getFullMessage() . PHP_EOL . PHP_EOL;
        }
    }

    public function testAlnum()
    {
        $this->doTestValidator(v::alnum(), '#');
        $this->doTestValidator(v::alnum('_'), '#');
    }

    public function testAlpha()
    {
        $this->doTestValidator(v::alpha(), '#');
        $this->doTestValidator(v::alpha('.'), '#');
    }

    public function testArr()
    {
        $this->doTestValidator(v::arr(), '#');
    }

    public function testAttribute()
    {
        $this->doTestValidator(v::attribute("foo", v::int()),
            (object) array("foo" => "bar"));
        $this->doTestValidator(v::attribute("foo", v::string()), null);
    }

    public function testBetween()
    {
        $this->doTestValidator(v::between(5, 15), 999);
        $this->doTestValidator(v::between('a', 'f'), 15951);
        $this->doTestValidator(v::between(new \DateTime('now'),
                new \DateTime('tomorrow')), new \DateTime('yesterday'));
    }

    public function testCall()
    {
        $this->doTestValidator(v::call('implode', v::int()), array('x', 2, 3, 4));
    }

    public function testCallback()
    {
        $this->doTestValidator(v::callback('is_string'), 123);
    }

    public function testDate()
    {
        $this->doTestValidator(v::date('Y-m-d'), '2010-30-10');
        $this->doTestValidator(v::date(), 'Jan 310 2008');
    }

    public function testDigits()
    {
        $this->doTestValidator(v::digits(), 'x02384');
    }

    public function testEach()
    {
        $this->doTestValidator(v::each(v::hexa()), array('AF', 'P1', '09'));
    }

    public function testEquals()
    {
        $this->doTestValidator(v::equals('foobar'), 'aaar');
    }

    public function testFloat()
    {
        $this->doTestValidator(v::float(), 'dance');
    }

    public function testHexa()
    {
        $this->doTestValidator(v::hexa(), 'PPAFAF');
    }

    public function testIn()
    {
        $this->doTestValidator(v::in(array(1, 1, 2, 3, 5, 8)), 9845984);
    }

    public function testInstance()
    {
        $this->doTestValidator(v::instance('\ss'), new \stdClass);
    }

    public function testInt()
    {
        $this->doTestValidator(v::int(), 15.48);
    }

    public function testIp()
    {
        $this->doTestValidator(v::ip(), '200.999.220.222');
    }

    public function testLength()
    {
        $this->doTestValidator(v::length(5, 10), 'foobarbalzobihbiy');
        $this->doTestValidator(v::length(2, 3), array(1, 2, 3, 4, 5));
        $this->doTestValidator(v::length(null, 3), array(1, 2, 3, 4, 5));
        $this->doTestValidator(v::length(15, null), array(1, 2, 3, 4, 5));
    }

    public function testMax()
    {
        $this->doTestValidator(v::max(5), 9854);
        $this->doTestValidator(v::max(5, true), 9854);
    }

    public function testMin()
    {
        $this->doTestValidator(v::min(5), -9514);
        $this->doTestValidator(v::min(5, true), -9514);
    }

    public function testNegative()
    {
        $this->doTestValidator(v::negative(), 5);
    }

    public function testPositive()
    {
        $this->doTestValidator(v::positive(), -3);
    }

    public function testNoWhitespace()
    {
        $this->doTestValidator(v::noWhitespace(), 'a bc');
    }

    public function testNotEmpty()
    {
        $this->doTestValidator(v::notEmpty(), '');
    }

    public function testNullValue()
    {
        $this->doTestValidator(v::nullValue(), true);
    }

    public function testNumeric()
    {
        $this->doTestValidator(v::numeric(), null);
    }

    public function testObject()
    {
        $this->doTestValidator(v::object(), null);
    }

    public function testRegex()
    {
        $this->doTestValidator(v::regex('/^[a-f]+$/'), 'abcdxxxef');
    }

    public function testString()
    {
        $this->doTestValidator(v::string(), null);
    }

    public function testSartsWith()
    {
        $this->doTestValidator(v::startsWith('Xello'), 'Hello World');
    }

    public function testEndsWith()
    {
        $this->doTestValidator(v::endsWith('Yorld'), 'Hello World');
    }

    public function testAllOf()
    {
        $this->doTestValidator(v::allOf(
                v::string(), //any string 
                v::length(5, 20), //between 5 and 20 chars
                v::noWhitespace()   //no whitespace allowed
            ), "# #");

//same as

        $this->doTestValidator(v::string()
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
        $this->doTestValidator($v, '');
        $this->doTestValidator($v, '');
        $this->doTestValidator($v, '');
    }

}
