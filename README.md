Respect Validation
==================

Respect\Validation is the most awesome validation engine ever created for PHP. Featuring:

- Fluent/Chained builders like `v::numeric()->positive()->between(1, 256)->validate($myNumber)` (more samples below)
- Composite validation (nested, grouped and related rules)
- Informative, awesome exceptions
- More than 30 fully tested validators
- PHP 5.3 only
- Possible integration with Zend 2.0 and Symfony 2.0 validators

Roadmap
-------

1. Validation message improvements (translation, contextualization)
2. Custom validators (create your own validation rules and exceptions)
3. PHPDocs for all classes, methods and files
4. End user complete docs

Installation
============

**CAUTION**, this is not ready for production! Use it just for fun until a 
stable version comes out.

1. PEAR Package

   Respect\Validation is available under a downloadable PEAR Package. To use it, 
   type the following commands in your terminal:

        git clone git://github.com/Respect/Validation.git RespectValidation
        cd RespectValidation/library/Respect/Validation/
        sudo pear install package.xml 

   On Ubuntu, this will install it under `/usr/share/php`, make sure you add
   that to your include_path.

2. Direct Download

   Just click "Download" up there, in GitHub and use the library folder.

Autoloading
-----------

You can set up Respect\Validation for autoloading. We recommend using the 
SplClassLoader. Here's a nice sample:


    set_include_path('/my/library' . PATH_SEPARATOR . get_include_path());
    require_once 'SplClassLoader.php';
    $respectLoader = new \SplClassLoader();
    $respectLoader->register();


Running Tests
-------------

We didn't created hundreds of tests just for us to apreciate. To run them, 
you'll need phpunit 3.5 or greater. Then, just chdir into the `/tests` folder 
we distribute and run them like this:

    cd /my/RespectValidation/tests
    phpunit .

You can tweak the phpunit.xml under that `/tests` folder to your needs.

Feature Guide
=============

Namespace import
----------------

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

    <?php
    use Respect\Validation\Validator as v;

Simple validation
-----------------

The Hello World validator is something like this:

    $number = 123;
    v::numeric()->validate($number); //true

Chained validation
------------------

It is possible to group and chain several validators:

    //From 1 to 15 non-whitespace alphanumeric characters 
    $validUsername = v::alnum()
                      ->noWhitespace()
                      ->length(1,15);

    $validUsername->validate('alganet'); //true

Validating object attributes
----------------------------

You can validate attributes of objects or keys of arrays and its values too:
    
    $validUser = v::attribute('username', $validUsername)    //reusing!
                  ->attribute('birthdate', v::date('Y-m-d'));

    $user = new \stdClass;
    $user->username = 'alganet';
    $user->birthdate = '1987-07-01';

    $validUser->validate($user); //true

Validator reuse (works on nested, big validators too!)
------------------------------------------------------

Once created, you can reuse your validator anywhere:

    $validUsername->validate('respect');            //true
    $validUsername->validate('alexandre gaigalas'); //false 
    $validUsername->validate('#$%');                //false 

Cool, informative exceptions
----------------------------

Respect\Validation produces a tree of validation messages that reflects
the groups, nests and composite validators you declared. The following code:

    try {
        $validUsername->assert('really messed up screen#name');
    } catch(\InvalidArgumentException $e) {
       echo $e->getFullMessage();
    }

Produces this message:

    \-All of the 3 required rules must pass
      |-"really messed up screen#name" must contain only letters (a-z), digits (0-9) and "_"
      |-"really messed up screen#name" must not contain whitespace
      \-"really messed up screen#name" must have a length between 1 and 15

Validation Methods
------------------

There are three different ways to validate something:

    $validUsername->validate('alganet'); //returns true or false (quicker)
    $validUsername->check('alganet');    //throws only the first error found (quicker)
    $validUsername->assert('alganet');   //throws all of the errors found (slower)

Message finding on nested Exceptions
------------------------------------

Nested exceptions are cool, but sometimes you need to retrieve a single message
from the validator. In these cases you can use the findRelated() method. Consider
the following scenario:

    $validBlogPost = v::object()
                      ->attribute('title',  v::string()->length(1,32))
                      ->attribute('author', $validUser)                 //reuse!
                      ->attribute('date',   v::date())
                      ->attribute('text',   v::string());

    $blogPost = new \stdClass;
    $blogPost->author = clone $validUser;
    $blogPost->author->username = '# invalid #';

Then, the following validation code:

    try {
        $validBlogPost->assert($blogPost);
    } catch (\InvalidArgumentException $e) {
        echo $e->findRelated('author', 'username', 'noWhitespace')->getMainMessage();
    }

Finds the specific noWhitespace message inside author->username and prints it:

>"# invalid #" must not contain whitespace

Using Zend and/or Symfony validators
------------------------------------

It is also possible to reuse validators from other frameworks (you need to put them
in your autoload routines):

    $validHostName = v::zend('hostname')->assert('google.com');
    $validTime     = v::sf('time')->assert('22:00:01');

Quick Reference
==============

A quick, possibly incomplete, list of validators and use reference:

Alphanumeric:

    v::alnum()->assert('abc 123');
    v::alnum('_|')->assert('a_bc _1|23');

Alpha chars:

    v::alpha()->assert('ab c');
    v::alpha('.')->assert('a. b.c');

Check if it is an array (works on every Traversable, Countable ArrayAccess):

    v::arr()->assert(array());
    v::arr()->assert(new \ArrayObject);

An attribute of an object ant its value:

    $myObject = new \stdClass;
    $myObject->foo = "bar";
    v::attribute("foo", v::string())->assert($myObject);

Between (works on numbers, digits and dates):

    v::between(5, 15)->assert(10);
    v::between('a', 'f')->assert('b');

A value after a function call (works with closures):

    v::call('implode', v::int())->assert(array(1, 2, 3, 4));

Validates using the return of a callback:

    v::callback('is_string')->assert('something');

Dates and date formats:

    v::date('Y-m-d')->assert('2010-10-10');
    v::date()->assert('Jan 10 2008');

Strings with digits:

    v::digits()->assert('02384');

Iterates and validates each element:

    v::each(v::hexa())->assert(array('AF', 'D1', '09'));

Check for equality:

    v::equals('foobar')->assert('foobar');

Float numbers

    v::float()->assert(1.5);

Hexadecimals:

    v::hexa()->assert('FAFAF');

Checks if a value is inside a set:

    v::in(array(1, 1, 2, 3, 5, 8))->assert(5);

Checks if an object is instance of a specific class or interface:

    v::instance('\stdClass')->assert(new \stdClass);

Integer numbers:

    v::int()->assert(1548);

IP addresses:

    v::ip()->assert('200.226.220.222');

Length of strings, arrays or everything Countable:

    v::length(5, 10)->assert('foobar');
    v::length(5, 10)->assert(array(1, 2, 3, 4, 5));

Max and Min:

    v::max(5)->assert(3);
    v::min(5)->assert(7);

Positive and Negative:

    v::negative()->assert(-5);
    v::positive()->assert(3);

Whitespace, empty and null

    v::noWhitespace()->assert('abc');
    v::notEmpty()->assert('aaa');
    v::nullValue()->assert(null);

Numeric values of all kinds:

    v::numeric()->assert(1.56e-5);

Objects:

    v::object()->assert(new \DateTime());

Regex evaluations:

    v::regex('^[a-f]+$')->assert('abcdef');

Strings:

    v::string()->assert('Hello World');

AllOf (checks all validators inside a composite):

    v::allOf(
        v::string(), //any string v::length(5, 20), //between 5 and 20 chars
        v::noWhitespace()   //no whitespace allowed
    )->assert('alganet');

    v::string()
     ->length(5, 20)
     ->noWhitespace()
     ->assert('alganet');

OneOf (checks for one valid inside of a composite):

    $v = v::oneOf(
        v::int()->positive(),   //positive integer or;
        v::float()->negative(), //negative float or; 
        v::nullValue()          //null
    );
    $v->assert(null); //true
    $v->assert(12);   //true
    $v->assert(-1.1); //true
    
