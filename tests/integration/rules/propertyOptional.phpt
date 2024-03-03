--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    // Simple
    'Default' => [v::propertyOptional('foo', v::intType()), (object) ['foo' => 'string']],
    'Negative' => [v::not(v::propertyOptional('foo', v::intType())), (object) ['foo' => 12]],
    'Negative with missing property' => [
        v::not(v::propertyOptional('foo', v::intType())),
        new stdClass(),
    ],

    // With custom name
    'With wrapped name, default' => [
        v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapped name, negative' => [
        v::not(v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With wrapper name, default' => [
        v::propertyOptional('foo', v::intType())->setName('Wrapper'),
        (object) ['foo' => 'string'],
    ],
    'With wrapper name, negative' => [
        v::not(v::propertyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not'),
        (object) ['foo' => 12],
    ],
    'With "Not" name, negative' => [
        v::not(v::propertyOptional('foo', v::intType()))->setName('Not'),
        (object) ['foo' => 12],
    ],

    // With custom template
    'With template, default' => [
        v::propertyOptional('foo', v::intType()),
        (object) ['foo' => 'string'],
        'Proper property planners plan precise property plots',
    ],
    'With template, negative' => [
        v::not(v::propertyOptional('foo', v::intType())),
        (object) ['foo' => 12],
        'Not proving prudent property planning promotes prosperity',
    ],
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

Negative with missing property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
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
Proper property planners plan precise property plots
- Proper property planners plan precise property plots
[
    'foo' => 'Proper property planners plan precise property plots',
]

With template, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not proving prudent property planning promotes prosperity
- Not proving prudent property planning promotes prosperity
[
    'foo' => 'Not proving prudent property planning promotes prosperity',
]

