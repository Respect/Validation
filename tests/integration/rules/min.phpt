--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::min(v::equals(1)), [2, 3]],
    'Negative' => [v::not(v::min(v::equals(1))), [1, 2, 3]],
    'With template' => [v::min(v::equals(1)), [2, 3], 'That did not go as planned'],
    'With name' => [v::min(v::equals(1))->setName('Options'), [2, 3]],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
As the minimum from `[2, 3]`, 2 must equal 1
- As the minimum from `[2, 3]`, 2 must equal 1
[
    'min' => 'As the minimum from `[2, 3]`, 2 must equal 1',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
As the minimum from `[1, 2, 3]`, 1 must not equal 1
- As the minimum from `[1, 2, 3]`, 1 must not equal 1
[
    'min' => 'As the minimum from `[1, 2, 3]`, 1 must not equal 1',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That did not go as planned
- That did not go as planned
[
    'min' => 'That did not go as planned',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
The minimum from Options must equal 1
- The minimum from Options must equal 1
[
    'min' => 'The minimum from Options must equal 1',
]
