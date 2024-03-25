--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$empty = [];
$nonIterable = null;
$default = [1, 2, 3];
$negative = [-3, -2, -1];


run([
    // Simple
    'Non-iterable' => [v::max(v::negative()), $nonIterable],
    'Empty' => [v::max(v::negative()), $empty],
    'Default' => [v::max(v::negative()), $default],
    'Negative' => [v::not(v::max(v::negative())), $negative],
    'With wrapped name, default' => [v::max(v::negative()->setName('Wrapped'))->setName('Wrapper'), $default],
    'With wrapper name, default' => [v::max(v::negative())->setName('Wrapper'), $default],
    'With wrapped name, negative' => [v::not(v::max(v::negative()->setName('Wrapped')))->setName('Wrapper'), $negative],
    'With wrapper name, negative' => [v::not(v::max(v::negative()))->setName('Wrapper'), $negative],
    'With template, default' => [v::max(v::negative()), $default, 'The maximum of the value is not what we expect'],
]);
?>
--EXPECT--
Non-iterable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`null` must be of type iterable
- `null` must be of type iterable
[
    'max' => '`null` must be of type iterable',
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
As the maximum of `[1, 2, 3]`, 3 must be negative
- As the maximum of `[1, 2, 3]`, 3 must be negative
[
    'max' => 'As the maximum of `[1, 2, 3]`, 3 must be negative',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
As the maximum of `[-3, -2, -1]`, -1 must not be negative
- As the maximum of `[-3, -2, -1]`, -1 must not be negative
[
    'max' => 'As the maximum of `[-3, -2, -1]`, -1 must not be negative',
]

With wrapped name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapped must be negative
- The maximum of Wrapped must be negative
[
    'max' => 'The maximum of Wrapped must be negative',
]

With wrapper name, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapper must be negative
- The maximum of Wrapper must be negative
[
    'max' => 'The maximum of Wrapper must be negative',
]

With wrapped name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapped must not be negative
- The maximum of Wrapped must not be negative
[
    'max' => 'The maximum of Wrapped must not be negative',
]

With wrapper name, negative
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of Wrapper must not be negative
- The maximum of Wrapper must not be negative
[
    'max' => 'The maximum of Wrapper must not be negative',
]

With template, default
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The maximum of the value is not what we expect
- The maximum of the value is not what we expect
[
    'max' => 'The maximum of the value is not what we expect',
]
