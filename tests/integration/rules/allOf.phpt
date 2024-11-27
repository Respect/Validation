--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

run([
    'Two rules' => [v::allOf(v::intType(), v::negative()), '2'],
    'Wrapped by "not"' => [v::not(v::allOf(v::intType(), v::positive())), 3],
    'Wrapping "not"' => [v::allOf(v::not(v::intType()), v::greaterThan(2)), 4],
    'With a single template' => [v::allOf(v::stringType(), v::arrayType()), 5, 'This is a single template'],
    'With multiple templates' => [
        v::allOf(v::stringType(), v::uppercase()),
        5,
        [
            '__root__' => 'Two things are wrong',
            'stringType' => 'Template for "stringType"',
            'uppercase' => 'Template for "uppercase"',
        ],
    ],
]);
?>
--EXPECT--
Two rules
⎺⎺⎺⎺⎺⎺⎺⎺⎺
"2" must be of type integer
- All of the required rules must pass for "2"
  - "2" must be of type integer
  - "2" must be negative
[
    '__root__' => 'All of the required rules must pass for "2"',
    'intType' => '"2" must be of type integer',
    'negative' => '"2" must be negative',
]

Wrapped by "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
3 must not be of type integer
- These rules must not pass for 3
  - 3 must not be of type integer
  - 3 must not be positive
[
    '__root__' => 'These rules must not pass for 3',
    'intType' => '3 must not be of type integer',
    'positive' => '3 must not be positive',
]

Wrapping "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
4 must not be of type integer
- 4 must not be of type integer
[
    'notIntType' => '4 must not be of type integer',
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
Template for "stringType"
- Two things are wrong
  - Template for "stringType"
  - Template for "uppercase"
[
    '__root__' => 'Two things are wrong',
    'stringType' => 'Template for "stringType"',
    'uppercase' => 'Template for "uppercase"',
]
