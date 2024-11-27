--FILE--
<?php

require 'vendor/autoload.php';

$arr = [
    'name' => 'w',
    'email' => 'hello@hello.com',
];

exceptionMessages(static function () use ($arr): void {
    v::create()
        ->key('name', v::lengthBetween(2, 32))
        ->key('email', v::email())
        ->assert($arr);
});
?>
--EXPECT--
[
    'name' => 'The length of name must be between 2 and 32',
]
