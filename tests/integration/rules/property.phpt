--FILE--
<?php

require 'vendor/autoload.php';

run([
    // Simple
    'Missing property' => [v::property('foo', v::intType()), new stdClass()],
    'Default' => [v::property('foo', v::intType()), (object) ['foo' => 'string']],
    'Inverted' => [v::not(v::property('foo', v::intType())), (object) ['foo' => 12]],
    'Double-inverted with missing property' => [
        v::not(v::not(v::property('foo', v::intType()))),
        new stdClass(),
    ],

    // With custom name
    'With wrapped name, missing property' => [
        v::property('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        new stdClass(),
    ],
    'With wrapped name, default' => [
        v::property('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapped name, inverted' => [
        v::not(v::property('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With wrapper name, default' => [
        v::property('foo', v::intType())->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapper name, missing property' => [
        v::property('foo', v::intType())->setName('Wrapper'),
        new stdClass(),
    ],
    'With wrapper name, inverted' => [
        v::not(v::property('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With "Not" name, inverted' => [
        v::not(v::property('foo', v::intType()))->setName('Not'),
        (object) ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [
        v::property('foo', v::intType()),
        (object) ['foo' => 'string'],
        'Particularly precautions perplexing property',
    ],
    'With template, inverted' => [
        v::not(v::property('foo', v::intType())),
        (object) ['foo' => 12],
        'Not a prompt prospect of a particularly primitive property',
    ],
]);
?>
--EXPECT--
Missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

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

Double-inverted with missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

With wrapped name, missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must be present
- Wrapped must be present
[
    'foo' => 'Wrapped must be present',
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

With wrapper name, missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
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
Particularly precautions perplexing property
- Particularly precautions perplexing property
[
    'foo' => 'Particularly precautions perplexing property',
]

With template, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not a prompt prospect of a particularly primitive property
- Not a prompt prospect of a particularly primitive property
[
    'foo' => 'Not a prompt prospect of a particularly primitive property',
]
