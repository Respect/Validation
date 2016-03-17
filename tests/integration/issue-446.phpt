--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$arr = [
    'name' => 'w',
    'email' => 'hello@hello.com',
];

try {
    v::create()
        ->key('name', v::length(2, 32))
        ->key('email', v::email())
        ->assert($arr);
} catch (NestedValidationException $e) {
    print_r($e->getMessages());
}
?>
--EXPECTF--
Array
(
    [0] => name must have a length between 2 and 32
)
