--FILE--
<?php

require 'vendor/autoload.php';

run([
    // Simple
    'Default' => [v::keyOptional('foo', v::intType()), ['foo' => 'string']],
    'Inverted' => [v::not(v::keyOptional('foo', v::intType())), ['foo' => 12]],
    'Inverted with missing key' => [
        v::not(v::keyOptional('foo', v::intType())),
        [],
    ],

    // With custom name
    'With wrapped name, default' => [
        v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        ['foo' => 'string'],
    ],
    'With wrapped name, inverted' => [
        v::not(v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        ['foo' => 12],
    ],
    'With wrapper name, default' => [
        v::keyOptional('foo', v::intType())->setName('Wrapper'),
        ['foo' => 'string'],
    ],
    'With wrapper name, inverted' => [
        v::not(v::keyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        ['foo' => 12],
    ],
    'With "Not" name, inverted' => [
        v::not(v::keyOptional('foo', v::intType()))->setName('Not'),
        ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [v::keyOptional('foo', v::intType()), ['foo' => 'string'], 'That key is off-key'],
    'With template, inverted' => [v::not(v::keyOptional('foo', v::intType())), ['foo' => 12], 'No off-key key'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
foo must be an integer
- foo must be an integer
[
    'foo' => 'foo must be an integer',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be an integer
- foo must not be an integer
[
    'foo' => 'foo must not be an integer',
]

Inverted with missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

With wrapped name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be an integer
- Wrapped must be an integer
[
    'foo' => 'Wrapped must be an integer',
]

With wrapped name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be an integer
- Wrapped must not be an integer
[
    'foo' => 'Wrapped must not be an integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be an integer
- foo must be an integer
[
    'foo' => 'foo must be an integer',
]

With wrapper name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be an integer
- foo must not be an integer
[
    'foo' => 'foo must not be an integer',
]

With "Not" name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be an integer
- foo must not be an integer
[
    'foo' => 'foo must not be an integer',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That key is off-key
- That key is off-key
[
    'foo' => 'That key is off-key',
]

With template, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
No off-key key
- No off-key key
[
    'foo' => 'No off-key key',
]
