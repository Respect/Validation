<?php

namespace Respect\Validation;

use Respect\Validation\Validator as v;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testAlnum()
    {
        v::alnum()->assert('abc 123');
        v::alnum('_')->assert('a_bc _123');
    }

    public function testAlpha()
    {
        v::alpha()->assert('ab c');
        v::alpha('.')->assert('a. b.c');
    }

    public function testArr()
    {
        v::arr()->assert(array());
    }

    public function testAttribute()
    {
        v::attribute("foo", v::string())->assert((object) array("foo" => "bar"));
    }

    public function testBetween()
    {
        v::between(5, 15)->assert(10);
        v::between('a', 'f')->assert('b');
    }

    public function testCall()
    {
        v::call('implode', v::int())->assert(array(1, 2, 3, 4));
    }

    public function testCallback()
    {
        v::callback('is_string')->assert('something');
    }

    public function testDate()
    {
        v::date('Y-m-d')->assert('2010-10-10');
        v::date()->assert('Jan 10 2008');
    }

    public function testDigits()
    {
        v::digits()->assert('02384');
    }

    public function testDomain()
    {
        v::domain()->assert('google.com');
    }

    public function testEach()
    {
        v::each(v::hexa())->assert(array('AF', 'D1', '09'));
    }

    public function testEquals()
    {
        v::equals('foobar')->assert('foobar');
    }

    public function testFloat()
    {
        v::float()->assert(1.5);
    }

    public function testHexa()
    {
        v::hexa()->assert('FAFAF');
    }

    public function testIn()
    {
        v::in(array(1, 1, 2, 3, 5, 8))->assert(5);
    }

    public function testInstance()
    {
        v::instance('\stdClass')->assert(new \stdClass);
    }

    public function testInt()
    {
        v::int()->assert(1548);
    }

    public function testIp()
    {
        v::ip()->assert('200.226.220.222');
    }

    public function testLength()
    {
        v::length(5, 10)->assert('foobar');
        v::length(5, 10)->assert(array(1, 2, 3, 4, 5));
    }

    public function testMax()
    {
        v::max(5)->assert(3);
    }

    public function testMin()
    {
        v::min(5)->assert(7);
    }

    public function testNegative()
    {
        v::negative()->assert(-5);
    }

    public function testPositive()
    {
        v::positive()->assert(3);
    }

    public function testNoWhitespace()
    {
        v::noWhitespace()->assert('abc');
    }

    public function testNotEmpty()
    {
        v::notEmpty()->assert('aaa');
    }

    public function testNullValue()
    {
        v::nullValue()->assert(null);
    }

    public function testNumeric()
    {
        v::numeric()->assert(1.56e-5);
    }

    public function testObject()
    {
        v::object()->assert(new \DateTime());
    }

    public function testRegex()
    {
        v::regex('^[a-f]+$')->assert('abcdef');
    }

    public function testString()
    {
        v::string()->assert('Hello World');
    }

    public function testSartsWith()
    {
        v::startsWith('Hello')->assert('Hello World');
    }

    public function testEndsWith()
    {
        v::endsWith('World')->assert('Hello World');
    }

    public function testAllOf()
    {
        v::allOf(
            v::string(), //any string v::length(5, 20), //between 5 and 20 chars
            v::noWhitespace()   //no whitespace allowed
        )->assert('alganet');

//same as

        v::string()
            ->length(5, 20)
            ->noWhitespace()
            ->assert('alganet');
    }

    public function testOneOf()
    {
        $v = v::oneOf(
                v::int()->positive(), //positive integer or;
                v::float()->negative(), //negative float or; 
                v::nullValue() //null
        );
        $v->assert(null);
        $v->assert(12);
        $v->assert(-1.1);
    }

    public function testCallbackCustomMessage()
    {
        try {
            v::callback('is_int')
                ->setTemplate('{{name}} is not tasty')
                ->assert('something');
        } catch (\Exception $e) {
            //echo $e->getFullMessage();
        }
    }

    public function testGmailSignInValidation()
    {
        $stringMax256 = v::string()->length(5, 256);
        $alnumDot = v::alnum('.');
        $stringMin8 = v::string()->length(8, null);
        $v = v::allOf(
                v::attribute('first_name', $stringMax256)->setName('First Name'),
                v::attribute('last_name', $stringMax256)->setName('Last Name'),
                v::attribute('desired_login', $alnumDot)->setName('Desired Login'),
                v::attribute('password', $stringMin8)->setName('Password'),
                v::attribute('password_confirmation', $stringMin8)->setName('Password Confirmation'),
                v::attribute('stay_signedin', v::notEmpty())->setName('Stay signed in'),
                v::attribute('enable_webhistory', v::notEmpty())->setName('Enabled Web History'),
                v::attribute('security_question', $stringMax256)->setName('Security Question')
            )->setName('Validation Form');
        try {
            $v->assert(
                (object) array(
                    'first_name' => 'fiif',
                    'last_name' => null,
                    'desired_login' => null,
                    'password' => null,
                    'password_confirmation' => null,
                    'stay_signedin' => null,
                    'enable_webhistory' => null,
                    'security_question' => null,
                )
            );
        } catch (Exceptions\ValidationException $e) {
            //echo $e->getFullMessage().PHP_EOL;
        }
    }

    public function testReadme()
    {
        $number = 123;
        v::numeric()->validate($number); //true
        //From 1 to 15 non-whitespace alphanumeric characters 
        $validUsername = v::alnum()
            ->noWhitespace()
            ->length(1, 15);

        $validUsername->validate('alganet'); //true
        $validUser = v::attribute('username', $validUsername)    //reusing!
            ->attribute('birthdate', v::date('Y-m-d'))
            ->attribute('birthdat', v::date('Y-m-d'));

        $user = new \stdClass;
        $user->username = 'alganet';
        $user->birthdate = '1987-07-01';

        $validUser->validate($user); //true


        $validUsername->validate('respect');            //true
        $validUsername->validate('alexandre gaigalas'); //false 
        $validUsername->validate('#$%');                //false 


        try {
            $validUsername->assert('really messed up screen#name');
        } catch (\InvalidArgumentException $e) {
            //echo $e->getFullMessage();
        }

        $validBlogPost = v::allOf(v::allOf(v::object()
                    ->attribute('title', v::string()->length(1, 32))
                    ->attribute('author', $validUser)                 //reuse!
                    ->attribute('date', v::date())
                    ->attribute('text', v::string())))
            ->setName('Blog Post')
            ->setTemplate("Not nice {{name}}");

        $blogPost = new \stdClass;
        $blogPost->author = clone $user;
        $blogPost->author->username = '# invalid #';

        try {
            $validBlogPost->assert($blogPost);
        } catch (\InvalidArgumentException $e) {
            //echo $e->getFullMessage() . PHP_EOL;
            //echo $e->findRelated('author')->getMainMessage();
        }
    }

}
