--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--DESCRIPTION--
The previous output was:

default must be of type string
- default must be of type string
--FILE--
<?php

declare(strict_types=1);

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\ArrayType;
use Respect\Validation\Rules\BoolType;
use Respect\Validation\Rules\Each;
use Respect\Validation\Rules\Key;
use Respect\Validation\Rules\OneOf;
use Respect\Validation\Rules\StringType;
use Respect\Validation\Rules\StringVal;
use Respect\Validation\Validator;

require 'vendor/autoload.php';

$validator = new Validator(
    new Each(
        new Validator(
            new Key(
                'default',
                new OneOf(
                    new StringType(),
                    new BoolType()
                ),
                false
            ),
            new Key(
                'description',
                new StringVal(),
                false
            ),
            new Key(
                'children',
                new ArrayType(),
                false
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
try {
    $validator->check($input);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    $validator->assert($input);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECT--
default must be of type string
- These rules must pass for `{ "default": 2, "description": { }, "children": { "nope" } }`
  - Only one of these rules must pass for default
    - default must be of type string
    - default must be of type boolean
  - description must be a string
