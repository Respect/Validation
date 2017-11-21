--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$data = [
    'password' => 'shuberry',
    'password_confirmation' => 'shuberry',
    'valid_passwords' => ['shuberry', 'monty-python'],
];

v::keyValue('password', 'equals', 'password_confirmation')->assert($data);
v::keyValue('password', 'in', 'valid_passwords')->assertAll($data);
?>
--EXPECTF--
