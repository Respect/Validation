--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::min(v::equals(1)), [2, 3]],
    'Inverted' => [v::not(v::min(v::equals(1))), [1, 2, 3]],
    'With template' => [v::min(v::equals(1)), [2, 3], 'That did not go as planned'],
    'With name' => [v::min(v::equals(1))->setName('Options'), [2, 3]],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
As the minimum from `[2, 3]`, 2 must be equal to 1
- As the minimum from `[2, 3]`, 2 must be equal to 1
[
    'minEquals' => 'As the minimum from `[2, 3]`, 2 must be equal to 1',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
As the minimum from `[1, 2, 3]`, 1 must not be equal to 1
- As the minimum from `[1, 2, 3]`, 1 must not be equal to 1
[
    'notMinEquals' => 'As the minimum from `[1, 2, 3]`, 1 must not be equal to 1',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That did not go as planned
- That did not go as planned
[
    'minEquals' => 'That did not go as planned',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
The minimum from Options must be equal to 1
- The minimum from Options must be equal to 1
[
    'minEquals' => 'The minimum from Options must be equal to 1',
]
