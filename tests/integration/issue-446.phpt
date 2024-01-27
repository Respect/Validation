--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$arr = [
    'name' => 'w',
    'email' => 'hello@hello.com',
];

exceptionMessages(static function () use ($arr) {
    v::create()
        ->key('name', v::length(2, 32))
        ->key('email', v::email())
        ->assert($arr);
});
?>
--EXPECT--
Array
(
    [name] => name must have a length between 2 and 32
)
