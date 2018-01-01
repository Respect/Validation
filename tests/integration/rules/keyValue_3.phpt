--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

$data = [
    'password' => 'shazam',
    'password_confirmation' => 'batman',
];

try {
    v::keyValue('password', 'equals', 'password_confirmation')->assert($data);
} catch (AllOfException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
All of the required rules must pass for `{ "password": "shazam", "password_confirmation": "batman" }`
