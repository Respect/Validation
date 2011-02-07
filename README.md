Respect Validation
==================

Respect\Validation is the most awesome validation engine ever created for PHP. Featuring:

- Fluent/Chained builders
- Composite validation (nested, grouped and related rules)
- Informative, awesome exceptions
- More than 30 fully tested validators
- PHP 5.3 only
- Possible integration with Zend 2.0 and Symfony 2.0 validators

Quick Reference
===============

Namespace import
----------------

    use Respect\Validation\Validator as v;

Simple validation
-----------------

    v::numeric()->validate($someNumber); //returns true or false

Chained validation
------------------

    //From 1 to 15 non-whitespace alphanumeric characters 
    $username = 'alganet';
    $validUsername = v::alnum()
                      ->noWhitespace()
                      ->length(1,15)
                      ->validate($username);

    //Date between two ranges using a specific format
    $someDate = new DateTime('2010-10-15');
    $validDate = v::date('Y-m-d')
                  ->between(new DateTime('2009-01-01'), new DateTime('2011-01-01'))
                  ->validate($someDate);

Validating object attributes
----------------------------

    $user = new \stdClass;
    $user->name = 'Alexandre';
    $user->birthdate = '1987-07-01';
    $validUser = v::attribute('name', v::notEmpty())
               ->v::attribute('birthdate, v::date('Y-m-d'));

Validator reuse (works on nested, big validators too!)
------------------------------------------------------

    $idValidator = v::int()->positive();
    $idValidator->validate(123); //true
    $idValidator->validate(456); //true
    $idValidator->validate('foo'); //false
    $idValidator->validate(178); //true

Cool, informative exceptions
----------------------------

    try {
        $username = '#some%really*bad screen name';
        $validUsername = v::alnum('_')
                          ->noWhitespace()
                          ->length(1,15)
                          ->assert($username);
    } catch(\InvalidArgumentException $e) {
       /* prints:
            \-None of 3 required rules passed
              |-"really messed up screen#name" does not contain only letters, digits and "_"
              |-"really messed up screen#name" contains whitespace
              \-"really messed up screen#name" length is not between 1 and 15
       */
       echo $e->getFullMessage();
    }

Message finding on nested Exceptions
------------------------------------

    $user = array("id" => "some %% invalid %% id");
    $post = array("user" => $user);
    try {
        v::key("user", v::key("id", v::int()->positive()))->assert($post);
    } catch (\InvalidArgumentException $e) {
        /* prints:
            "some %% invalid %% id" is not a positive number
        */
        echo $e->findRelated('user', 'id', 'positive')->getMainMessage();
    }

Using Zend and/or Symfony validators
------------------------------------

    $validHostName = v::zend('hostname')->assert('google.com');
    $validTime     = v::sf('time')->assert('22:00:01');
 
Cool, isn't it?

Roadmap
=======

- Custom validators (create your own validation rules and exceptions)
- Validation message improvements (translation, contextualization)


