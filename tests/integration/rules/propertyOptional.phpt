--FILE--
<?php

require 'vendor/autoload.php';

run([
    // Simple
    'Default' => [v::propertyOptional('foo', v::intType()), (object) ['foo' => 'string']],
    'Inverted' => [v::not(v::propertyOptional('foo', v::intType())), (object) ['foo' => 12]],
    'Inverted with missing property' => [
        v::not(v::propertyOptional('foo', v::intType())),
        new stdClass(),
    ],

    // With custom name
    'With wrapped name, default' => [
        v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapped name, inverted' => [
        v::not(v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With wrapper name, default' => [
        v::propertyOptional('foo', v::intType())->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapper name, inverted' => [
        v::not(v::propertyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With "Not" name, inverted' => [
        v::not(v::propertyOptional('foo', v::intType()))->setName('Not'),
        (object) ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [
        v::propertyOptional('foo', v::intType()),
        (object) ['foo' => 'string'],
        'Proper property planners plan precise property plots',
    ],
    'With template, inverted' => [
        v::not(v::propertyOptional('foo', v::intType())),
        (object) ['foo' => 12],
        'Not proving prudent property planning promotes prosperity',
    ],
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

Inverted with missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
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
Proper property planners plan precise property plots
- Proper property planners plan precise property plots
[
    'foo' => 'Proper property planners plan precise property plots',
]

With template, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not proving prudent property planning promotes prosperity
- Not proving prudent property planning promotes prosperity
[
    'foo' => 'Not proving prudent property planning promotes prosperity',
]
