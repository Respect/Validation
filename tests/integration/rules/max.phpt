--FILE--
<?php

require 'vendor/autoload.php';

$empty = [];
$nonIterable = null;
$default = [1, 2, 3];
$negative = [-3, -2, -1];


run([
    // Simple
    'Non-iterable' => [v::max(v::negative()), $nonIterable],
    'Empty' => [v::max(v::negative()), $empty],
    'Default' => [v::max(v::negative()), $default],
    'Inverted' => [v::not(v::max(v::negative())), $negative],
    'With wrapped name, default' => [v::max(v::negative()->setName('Wrapped'))->setName('Wrapper'), $default],
    'With wrapper name, default' => [v::max(v::negative())->setName('Wrapper'), $default],
    'With wrapped name, inverted' => [v::not(v::max(v::negative()->setName('Wrapped')))->setName('Wrapper'), $negative],
    'With wrapper name, inverted' => [v::not(v::max(v::negative()))->setName('Wrapper'), $negative],
    'With template, default' => [v::max(v::negative()), $default, 'The maximum of the value is not what we expect'],
]);
?>
--EXPECT--
Non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`null` must be iterable
- `null` must be iterable
[
    'max' => '`null` must be iterable',
]

Empty
⎺⎺⎺⎺⎺
The value must not be empty
- The value must not be empty
[
    'max' => 'The value must not be empty',
]

Default
⎺⎺⎺⎺⎺⎺⎺
As the maximum of `[1, 2, 3]`, 3 must be a negative number
- As the maximum of `[1, 2, 3]`, 3 must be a negative number
[
    'maxNegative' => 'As the maximum of `[1, 2, 3]`, 3 must be a negative number',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
As the maximum of `[-3, -2, -1]`, -1 must not be a negative number
- As the maximum of `[-3, -2, -1]`, -1 must not be a negative number
[
    'notMaxNegative' => 'As the maximum of `[-3, -2, -1]`, -1 must not be a negative number',
]

With wrapped name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapped must be a negative number
- The maximum of Wrapped must be a negative number
[
    'maxNegative' => 'The maximum of Wrapped must be a negative number',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapper must be a negative number
- The maximum of Wrapper must be a negative number
[
    'maxNegative' => 'The maximum of Wrapper must be a negative number',
]

With wrapped name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapped must not be a negative number
- The maximum of Wrapped must not be a negative number
[
    'notMaxNegative' => 'The maximum of Wrapped must not be a negative number',
]

With wrapper name, inverted
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapper must not be a negative number
- The maximum of Wrapper must not be a negative number
[
    'notMaxNegative' => 'The maximum of Wrapper must not be a negative number',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of the value is not what we expect
- The maximum of the value is not what we expect
[
    'maxNegative' => 'The maximum of the value is not what we expect',
]
