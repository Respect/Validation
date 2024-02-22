--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    // Simple
    'Default' => [v::keyOptional('foo', v::intType()), ['foo' => 'string']],
    'Negative' => [v::not(v::keyOptional('foo', v::intType())), ['foo' => 12]],
    'Negative with missing key' => [
        v::not(v::keyOptional('foo', v::intType())),
        [],
    ],

    // With custom name
    'With wrapped name, default' => [
        v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        ['foo' => 'string'],
    ],
    'With wrapped name, negative' => [
        v::not(v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        ['foo' => 12],
    ],
    'With wrapper name, default' => [
        v::keyOptional('foo', v::intType())->setName('Wrapper'),
        ['foo' => 'string'],
    ],
    'With wrapper name, negative' => [
        v::not(v::keyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        ['foo' => 12],
    ],
    'With "Not" name, negative' => [
        v::not(v::keyOptional('foo', v::intType()))->setName('Not'),
        ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [v::keyOptional('foo', v::intType()), ['foo' => 'string'], 'That key is off-key'],
    'With template, negative' => [v::not(v::keyOptional('foo', v::intType())), ['foo' => 12], 'No off-key key'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
foo must be of type integer
- foo must be of type integer
[
    'foo' => 'foo must be of type integer',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be of type integer
- foo must not be of type integer
[
    'foo' => 'foo must not be of type integer',
]

Negative with missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

With wrapped name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be of type integer
- Wrapped must be of type integer
[
    'Wrapped' => 'Wrapped must be of type integer',
]

With wrapped name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be of type integer
- Wrapped must not be of type integer
[
    'Wrapped' => 'Wrapped must not be of type integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be of type integer
- foo must be of type integer
[
    'foo' => 'foo must be of type integer',
]

With wrapper name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be of type integer
- foo must not be of type integer
[
    'foo' => 'foo must not be of type integer',
]

With "Not" name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be of type integer
- foo must not be of type integer
[
    'foo' => 'foo must not be of type integer',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That key is off-key
- That key is off-key
[
    'foo' => 'That key is off-key',
]

With template, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
No off-key key
- No off-key key
[
    'foo' => 'No off-key key',
]

