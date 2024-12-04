--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::lazy(static fn() => v::intType()), true],
    'Inverted' => [v::not(v::lazy(static fn() => v::intType())), 2],
    'With created name, default' => [
        v::lazy(static fn() => v::intType()->setName('Created'))->setName('Wrapper'),
        true,
    ],
    'With wrapper name, default' => [
        v::lazy(static fn() => v::intType())->setName('Wrapper'),
        true,
    ],
    'With created name, inverted' => [
        v::not(v::lazy(static fn() => v::intType()->setName('Created'))->setName('Wrapped'))->setName('Not'),
        2,
    ],
    'With wrapper name, inverted' => [
        v::not(v::lazy(static fn() => v::intType())->setName('Wrapped'))->setName('Not'),
        2,
    ],
    'With not name, inverted' => [
        v::not(v::lazy(static fn() => v::intType()))->setName('Not'),
        2,
    ],
    'With template, default' => [
        v::lazy(static fn() => v::intType()),
        true,
        'Lazy lizards lounging like lords in the local lagoon',
    ],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
`true` must be an integer
- `true` must be an integer
[
    'intType' => '`true` must be an integer',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
2 must not be an integer
- 2 must not be an integer
[
    'notIntType' => '2 must not be an integer',
]

With created name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Created must be an integer
- Created must be an integer
[
    'intType' => 'Created must be an integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must be an integer
- Wrapper must be an integer
[
    'intType' => 'Wrapper must be an integer',
]

With created name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Created must not be an integer
- Created must not be an integer
[
    'notIntType' => 'Created must not be an integer',
]

With wrapper name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be an integer
- Wrapped must not be an integer
[
    'notIntType' => 'Wrapped must not be an integer',
]

With not name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be an integer
- Not must not be an integer
[
    'notIntType' => 'Not must not be an integer',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Lazy lizards lounging like lords in the local lagoon
- Lazy lizards lounging like lords in the local lagoon
[
    'intType' => 'Lazy lizards lounging like lords in the local lagoon',
]
