--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    // Simple
    'Missing property' => [v::property('foo', v::intType()), new stdClass()],
    'Default' => [v::property('foo', v::intType()), (object) ['foo' => 'string']],
    'Negative' => [v::not(v::property('foo', v::intType())), (object) ['foo' => 12]],
    'Double-negative with missing property' => [
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
    'With wrapped name, negative' => [
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
    'With wrapper name, negative' => [
        v::not(v::property('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With "Not" name, negative' => [
        v::not(v::property('foo', v::intType()))->setName('Not'),
        (object) ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [
        v::property('foo', v::intType()),
        (object) ['foo' => 'string'],
        'Particularly precautions perplexing property',
    ],
    'With template, negative' => [
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

Double-negative with missing property
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
Wrapped must be of type integer
- Wrapped must be of type integer
[
    'foo' => 'Wrapped must be of type integer',
]

With wrapped name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be of type integer
- Wrapped must not be of type integer
[
    'foo' => 'Wrapped must not be of type integer',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be of type integer
- foo must be of type integer
[
    'foo' => 'foo must be of type integer',
]

With wrapper name, missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
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
Particularly precautions perplexing property
- Particularly precautions perplexing property
[
    'foo' => 'Particularly precautions perplexing property',
]

With template, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not a prompt prospect of a particularly primitive property
- Not a prompt prospect of a particularly primitive property
[
    'foo' => 'Not a prompt prospect of a particularly primitive property',
]
