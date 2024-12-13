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
exceptionMessage(static fn() => $validator->assert($input));
exceptionFullMessage(static fn() => $validator->assert($input));
?>
--EXPECT--
default must be a string
- These rules must pass for `["default": 2, "description": [], "children": ["nope"]]`
  - Only one of these rules must pass for default
    - default must be a string
    - default must be a boolean
  - description must be a string value