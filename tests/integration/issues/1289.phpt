--FILE--
<?php

use Respect\Validation\Rules\ArrayType;
use Respect\Validation\Rules\BoolType;
use Respect\Validation\Rules\Each;
use Respect\Validation\Rules\KeyOptional;
use Respect\Validation\Rules\OneOf;
use Respect\Validation\Rules\StringType;
use Respect\Validation\Rules\StringVal;
use Respect\Validation\Validator;

require 'vendor/autoload.php';

$validator = Validator::create(
    new Each(
        Validator::create(
            new KeyOptional(
                'default',
                new OneOf(
                    new StringType(),
                    new BoolType()
                )
            ),
            new KeyOptional(
                'description',
                new StringVal(),
            ),
            new KeyOptional(
                'children',
                new ArrayType(),
            )
        )
    )
);

$input = [
    [
        'default' => 2,
        'description' => [],
        'children' => ['nope'],
    ],
];
exceptionAll('https://github.com/Respect/Validation/issues/1289', static fn() => $validator->assert($input));
?>
--EXPECT--
https://github.com/Respect/Validation/issues/1289
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
default must be a string
- These rules must pass for `["default": 2, "description": [], "children": ["nope"]]`
  - Only one of these rules must pass for default
    - default must be a string
    - default must be a boolean
  - description must be a string value
[
    'allOf' => [
        '__root__' => 'These rules must pass for `["default": 2, "description": [], "children": ["nope"]]`',
        'default' => [
            '__root__' => 'Only one of these rules must pass for default',
            'stringType' => 'default must be a string',
            'boolType' => 'default must be a boolean',
        ],
        'description' => 'description must be a string value',
    ],
]
