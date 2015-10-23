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
             ->key('birthdate', Validator::date())
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
    [0] => username must have a length between 2 and 32
    [1] => birthdate must be a valid date
    [2] => password must not be empty
    [3] => Key email must be present
)
