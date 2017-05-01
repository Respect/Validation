--TEST--
keys as validator names
--FILE--
<?php

date_default_timezone_set('UTC');

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    Validator::key('username', Validator::length(2, 32))
             ->key('birthdate', Validator::dateTime())
             ->setName('User Subscription Form')
             ->assert(['username' => '0', 'birthdate' => 'Whatever']);
} catch (NestedValidationException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- All of the required rules must pass for User Subscription Form
  - username must have a length between 2 and 32
  - birthdate must be a valid date/time
