--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::length(v::equals(3)), 'tulip'],
    'Inverted wrapped' => [v::length(v::not(v::equals(4))), 'rose'],
    'Inverted wrapper' => [v::not(v::length(v::equals(4))), 'fern'],
    'With template' => [v::length(v::equals(3)), 'azalea', 'This is a template'],
    'With wrapper name' => [v::length(v::equals(3))->setName('Cactus'), 'peyote'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
The length of "tulip" must be equal to 3
- The length of "tulip" must be equal to 3
[
    'lengthEquals' => 'The length of "tulip" must be equal to 3',
]

Inverted wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of "rose" must not be equal to 4
- The length of "rose" must not be equal to 4
[
    'lengthNotEquals' => 'The length of "rose" must not be equal to 4',
]

Inverted wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of "fern" must not be equal to 4
- The length of "fern" must not be equal to 4
[
    'notLengthEquals' => 'The length of "fern" must not be equal to 4',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
This is a template
- This is a template
[
    'lengthEquals' => 'This is a template',
]

With wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of Cactus must be equal to 3
- The length of Cactus must be equal to 3
[
    'lengthEquals' => 'The length of Cactus must be equal to 3',
]
