--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

run([
    'Default' => [v::lazy(static fn() => v::intType()), true],
    'Negative' => [v::not(v::lazy(static fn() => v::intType())), 2],
    'With created name, default' => [
        v::lazy(static fn() => v::intType()->setName('Created'))->setName('Wrapper'),
        true,
    ],
    'With wrapper name, default' => [
        v::lazy(static fn() => v::intType())->setName('Wrapper'),
        true,
    ],
    'With created name, negative' => [
        v::not(v::lazy(static fn() => v::intType()->setName('Created'))->setName('Wrapped'))->setName('Not'),
        2,
    ],
    'With wrapper name, negative' => [
        v::not(v::lazy(static fn() => v::intType())->setName('Wrapped'))->setName('Not'),
        2,
    ],
    'With not name, negative' => [
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
`true` must be of type integer
- `true` must be of type integer
[
    'intType' => '`true` must be of type integer',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
2 must not be of type integer
- 2 must not be of type integer
[
    'notIntType' => '2 must not be of type integer',
]

With created name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Created must be of type integer
- Created must be of type integer
[
    'intType' => 'Created must be of type integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must be of type integer
- Wrapper must be of type integer
[
    'intType' => 'Wrapper must be of type integer',
]

With created name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Created must not be of type integer
- Created must not be of type integer
[
    'notIntType' => 'Created must not be of type integer',
]

With wrapper name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be of type integer
- Wrapped must not be of type integer
[
    'notIntType' => 'Wrapped must not be of type integer',
]

With not name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be of type integer
- Not must not be of type integer
[
    'notIntType' => 'Not must not be of type integer',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Lazy lizards lounging like lords in the local lagoon
- Lazy lizards lounging like lords in the local lagoon
[
    'intType' => 'Lazy lizards lounging like lords in the local lagoon',
]
