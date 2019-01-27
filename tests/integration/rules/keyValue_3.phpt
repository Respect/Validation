--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
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
    echo $e->getMessage();
}
?>
--EXPECT--
All of the required rules must pass for `{ "password": "shazam", "password_confirmation": "batman" }`
