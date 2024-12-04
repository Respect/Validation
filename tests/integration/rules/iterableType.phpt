--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::iterableType(), null],
    'Inverted' => [v::not(v::iterableType()), [1, 2, 3]],
    'With template' => [v::iterableType(), null, 'Not an iterable at all'],
    'With name' => [v::iterableType()->setName('Options'), null],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
`null` must be iterable
- `null` must be iterable
[
    'iterableType' => '`null` must be iterable',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
`[1, 2, 3]` must not iterable
- `[1, 2, 3]` must not iterable
[
    'notIterableType' => '`[1, 2, 3]` must not iterable',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not an iterable at all
- Not an iterable at all
[
    'iterableType' => 'Not an iterable at all',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
Options must be iterable
- Options must be iterable
[
    'iterableType' => 'Options must be iterable',
]
