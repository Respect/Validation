<?php

namespace Respect\Validation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testAlnum()
    {
        Validator::alnum()->assert('abc 123');
        Validator::alnum('_')->assert('a_bc _123');
    }

    public function testAlpha()
    {
        Validator::alpha()->assert('ab c');
        Validator::alpha('.')->assert('a. b.c');
    }

    public function testArr()
    {
        Validator::arr()->assert(array());
    }

    public function testBetween()
    {
        Validator::between(5, 15)->assert(10);
        Validator::between('a', 'f')->assert('b');
    }

    public function testDate()
    {
        Validator::date('Y-m-d')->assert('2010-10-10');
        Validator::date()->assert('Jan 10 2008');
    }

    public function testDigits()
    {
        Validator::digits()->assert('02384');
    }

    public function testEquals()
    {
        Validator::equals('foobar')->assert('foobar');
    }

    public function testFloat()
    {
        Validator::float()->assert(1.5);
    }

    public function testHexa()
    {
        Validator::hexa()->assert('FAFAF');
    }

    public function testIn()
    {
        Validator::in(array(1, 1, 2, 3, 5, 8))->assert(5);
    }

    public function testInstance()
    {
        Validator::instance('\stdClass')->assert(new \stdClass);
    }

    public function testInt()
    {
        Validator::int()->assert(1548);
    }

    public function testIp()
    {
        Validator::ip()->assert('200.226.220.222');
    }

    public function testLength()
    {
        Validator::length(5, 10)->assert('foobar');
        Validator::length(5, 10)->assert(array(1, 2, 3, 4, 5));
    }

    public function testMax()
    {
        Validator::max(5)->assert(3);
    }

    public function testMin()
    {
        Validator::min(5)->assert(7);
    }

    public function testNegative()
    {
        Validator::negative()->assert(-5);
    }

    public function testPositive()
    {
        Validator::positive()->assert(3);
    }

    public function testNoWhitespace()
    {
        Validator::noWhitespace()->assert('abc');
    }

    public function testNotEmpty()
    {
        Validator::notEmpty()->assert('aaa');
    }

    public function testNullValue()
    {
        Validator::nullValue()->assert(null);
    }

    public function testNumeric()
    {
        Validator::numeric()->assert(1.56e-5);
    }

    public function testObject()
    {
        Validator::object()->assert(new \DateTime());
    }

    public function testRegex()
    {
        Validator::regex('[a-f]+')->assert('abcdef');
    }

    public function testString()
    {
        Validator::string()->assert('Hello World');
    }

    public function testAllOf()
    {
        Validator::allOf(
            Validator::string(), //any string
            Validator::length(5, 20), //between 5 and 20 chars
            Validator::noWhitespace()   //no whitespace allowed
        )->assert('alganet');

        //same as

        Validator::string()
            ->length(5, 20)
            ->noWhitespace()
            ->assert('alganet');
    }

    public function testOneOf()
    {
        $v = Validator::oneOf(
                Validator::int()->positive(), //positive integer or;
                Validator::float()->negative(), //negative float or; 
                Validator::nullValue() //null
        );
        $v->assert(null);
        $v->assert(12);
        $v->assert(-1.1);
    }

    public function testFullCase()
    {
        $target = array(
            "id" => 10,
            "text" => "wow, Respect rocks!!!",
            "created_at" => '2011-01-01',
            "user" => array(
                "id" => 20,
                "screen_name" => "respect",
                "bio" => "great validation tool",
                "created_at" => '2010-01-01',
                "lists" => array(
                    "php" => array(
                        "created_at" => '2010-01-02',
                        "description" => "PHP users"
                    ),
                    "rest" => array(
                        "created_at" => '2010-01-02',
                        "description" => "RESTfarians"
                    ),
                )
            ),
        );
        //quick nice hack to turn an array into an object
        $target = json_decode(json_encode($target));
        $v = Validator::allOf(
                Validator::attribute("id", $idVal = Validator::int()->positive()),
                Validator::attribute("text",
                    $textVal = Validator::string()->length(1, 140)),
                Validator::attribute("created_at",
                    $dateVal = Validator::date()->between(null, new \DateTime())),
                Validator::attribute("user",
                    Validator::allOf(
                        Validator::attribute("id", $idVal),
                        Validator::attribute("screen_name",
                            Validator::alnum("_")->noWhitespace()->length(1, 15)),
                        Validator::attribute("bio", $textVal),
                        Validator::attribute("created_at", $dateVal),
                        Validator::attribute("lists",
                            Validator::each(
                                Validator::allOf(
                                    Validator::attribute("created_at", $dateVal),
                                    Validator::attribute("description", $textVal)
                                )
                            )
                        )
                    )
                )
        );
        $target->user->lists->php = null;
        try {
            $v->assert($target);
        } catch (\Exception $e) {
            echo $e->findRelated('user', 'lists')->getFullMessage();
        }
    }

}
