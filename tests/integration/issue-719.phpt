--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$input = [
    'user_name' => 'MyName111',
    'user_surname' => 'MySurname111',
    'user_tel' => 'asd123'
];

$rules = [
    v::key('user_name',     v::numeric())->setName('First Name'),
    v::key('user_surname',  v::numeric())->setName('Second Name'),
    v::key('user_tel',      v::phone())->setName('Phone number'),
];

try{
    v::allOf($rules)->setName('Validation Form')->assert($input);
} catch (NestedValidationException $exception) {
    print_r($exception->findMessages(array_keys($input)));
}
?>
--EXPECTF--
Array
(
    [user_name] => user_name must be numeric
    [user_surname] => user_surname must be numeric
    [user_tel] => user_tel must be a valid telephone number
)
