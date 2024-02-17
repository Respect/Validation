--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Single rule' => [v::allOf(v::stringType()), 1],
    'Two rules' => [v::allOf(v::intType(), v::negative()), '2'],
    'Wrapped by "not"' => [v::not(v::allOf(v::intType(), v::positive())), 3],
    'Wrapping "not"' => [v::allOf(v::not(v::intType(), v::positive())), 4],
    'With a single template' => [v::allOf(v::stringType()), 5, 'This is a single template'],
    'With multiple templates' => [
        v::allOf(v::stringType(), v::uppercase()),
        5,
        ['allOf' => 'Unfortunately, we cannot template this'],
    ],
]);
?>
--EXPECT--
Single rule
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1 must be of type string
- 1 must be of type string
[
    'allOf' => '1 must be of type string',
]

Two rules
⎺⎺⎺⎺⎺⎺⎺⎺⎺
"2" must be of type integer
- All of the required rules must pass for "2"
  - "2" must be of type integer
  - "2" must be negative
[
    'allOf' => '"2" must be negative',
]

Wrapped by "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
3 must not be of type integer
- 3 must not be of type integer
[
    'intType' => '3 must not be of type integer',
]

Wrapping "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
4 must not be of type integer
- 4 must not be of type integer
[
    'allOf' => '4 must not be of type integer',
]

With a single template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
This is a single template
- This is a single template
[
    'allOf' => 'This is a single template',
]

With multiple templates
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
5 must be of type string
- All of the required rules must pass for 5
  - 5 must be of type string
  - 5 must be uppercase
[
    'allOf' => '5 must be uppercase',
]
