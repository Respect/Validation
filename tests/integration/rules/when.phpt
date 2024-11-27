--FILE--
<?php

require 'vendor/autoload.php';

run([
    'When valid use "then"' => [v::when(v::intVal(), v::positive(), v::notEmpty()), -1],
    'When invalid use "else"' => [v::when(v::intVal(), v::positive(), v::notEmpty()), ''],
    'When valid use "then" using single template' => [
        v::when(v::intVal(), v::positive(), v::notEmpty()),
        -1,
        'That did not go as planned',
    ],
    'When invalid use "else" using single template' => [
        v::when(v::intVal(), v::positive(), v::notEmpty()),
        '',
        'That could have been better',
    ],
    'When valid use "then" using array template' => [
        v::when(v::intVal(), v::positive(), v::notEmpty()),
        -1,
        [
            'notEmpty' => '--Never shown--',
            'positive' => 'Not positive',
        ],
    ],
    'When invalid use "else" using array template' => [
        v::when(v::intVal(), v::positive(), v::notEmpty()),
        '',
        [
            'notEmpty' => 'Not empty',
            'positive' => '--Never shown--',
        ],
    ],
]);
?>
--EXPECT--
When valid use "then"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
-1 must be positive
- -1 must be positive
[
    'positive' => '-1 must be positive',
]

When invalid use "else"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be empty
- The value must not be empty
[
    'notEmpty' => 'The value must not be empty',
]

When valid use "then" using single template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That did not go as planned
- That did not go as planned
[
    'positive' => 'That did not go as planned',
]

When invalid use "else" using single template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That could have been better
- That could have been better
[
    'notEmpty' => 'That could have been better',
]

When valid use "then" using array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not positive
- Not positive
[
    'positive' => 'Not positive',
]

When invalid use "else" using array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not empty
- Not empty
[
    'notEmpty' => 'Not empty',
]
