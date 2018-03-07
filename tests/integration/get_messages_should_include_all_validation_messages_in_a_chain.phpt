--TEST--
getMessages() should include all validation messages in a chain
--FILE--
<?php

date_default_timezone_set('UTC');

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    $input = [
        'username' => 'u',
        'birthdate' => 'Not a date',
        'password' => '',
    ];

    Validator::key('username', Validator::length(2, 32))
             ->key('birthdate', Validator::dateTime())
             ->key('password', Validator::notEmpty())
             ->key('email', Validator::email())
             ->assert($input);
} catch (NestedValidationException $e) {
    print_r($e->getMessages());
}
?>
--EXPECTF--
Array
(
    [username] => username must have a length between 2 and 32
    [birthdate] => birthdate must be a valid date/time
    [password] => password must not be empty
    [email] => Key email must be present
)
