--FILE--
<?php

date_default_timezone_set('UTC');

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessages(static function (): void {
    $input = [
        'username' => 'u',
        'birthdate' => 'Not a date',
        'password' => '',
    ];

    Validator::create()
        ->key('username', Validator::lengthBetween(2, 32))
        ->key('birthdate', Validator::dateTime())
        ->key('password', Validator::notEmpty())
        ->key('email', Validator::email())
        ->assert($input);
});
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for `["username": "u", "birthdate": "Not a date", "password": ""]`',
    'username' => 'The length of username must be between 2 and 32',
    'birthdate' => 'birthdate must be a valid date/time',
    'password' => 'password must not be empty',
    'email' => 'email must be present',
]
