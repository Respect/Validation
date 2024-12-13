--FILE--
<?php

require 'vendor/autoload.php';

$arr = [
    'name' => 'w',
    'email' => 'hello@hello.com',
];

exceptionAll('https://github.com/Respect/Validation/issues/446', static function () use ($arr): void {
    v::create()
        ->key('name', v::lengthBetween(2, 32))
        ->key('email', v::email())
        ->assert($arr);
});
?>
--EXPECT--
https://github.com/Respect/Validation/issues/446
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of name must be between 2 and 32
- These rules must pass for `["name": "w", "email": "hello@hello.com"]`
  - The length of name must be between 2 and 32
[
    'name' => 'The length of name must be between 2 and 32',
]
