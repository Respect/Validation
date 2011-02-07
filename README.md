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

    <?php
    use Respect\Validation\Validator as v;

Simple validation
-----------------

    $number = 123;
    v::numeric()->validate($number); //true

Chained validation
------------------

    //From 1 to 15 non-whitespace alphanumeric characters 
    $validUsername = v::alnum()
                      ->noWhitespace()
                      ->length(1,15);

    $validUsername->validate('alganet'); //true

Validating object attributes
----------------------------
    
    $validUser = v::attribute('username', $validUsername)    //reusing!
                  ->attribute('birthdate', v::date('Y-m-d'));

    $user = new \stdClass;
    $user->username = 'alganet';
    $user->birthdate = '1987-07-01';

    $validUser->validate($user); //true

Validator reuse (works on nested, big validators too!)
------------------------------------------------------

    $validUsername->validate('respect');            //true
    $validUsername->validate('alexandre gaigalas'); //false 
    $validUsername->validate('#$%');                //false 

Cool, informative exceptions
----------------------------

The following code:

    try {
        $validUsername->assert('really messed up screen#name');
    } catch(\InvalidArgumentException $e) {
       echo $e->getFullMessage();
    }

Produces this message:

    \-None of 3 required rules passed
      |-"really messed up screen#name" does not contain only letters, digits and "_"
      |-"really messed up screen#name" contains whitespace
      \-"really messed up screen#name" length is not between 1 and 15

Message finding on nested Exceptions
------------------------------------

Consider the following scenario:

    $validBlogPost = v::object()
                      ->attribute('title',  v::string()->length(1,32))
                      ->attribute('author', $validUser)                 //reuse!
                      ->attribute('date',   v::date())
                      ->attribute('text',   v::string());

    $blogPost = new \stdClass;
    $blogPost->author = clone $validUser;
    $blogPost->author->username = '# invalid #';

The following code:

    try {
        $validBlogPost->assert($blogPost);
    } catch (\InvalidArgumentException $e) {
        echo $e->findRelated('author', 'username', 'noWhitespace')->getMainMessage();
    }

Finds the specific noWhitespace message inside author->username and prints it:

>"# invalid #" contains whitespace

Using Zend and/or Symfony validators
------------------------------------

    $validHostName = v::zend('hostname')->assert('google.com');
    $validTime     = v::sf('time')->assert('22:00:01');
 
Cool, isn't it?

Roadmap
=======

- Custom validators (create your own validation rules and exceptions)
- Validation message improvements (translation, contextualization)


