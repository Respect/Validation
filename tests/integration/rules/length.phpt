--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::length(v::equals(3)), 'tulip'],
    'Negative wrapped' => [v::length(v::not(v::equals(4))), 'rose'],
    'Negative wrapper' => [v::not(v::length(v::equals(4))), 'fern'],
    'With template' => [v::length(v::equals(3)), 'azalea', 'This is a template'],
    'With wrapper name' => [v::length(v::equals(3))->setName('Cactus'), 'peyote'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
The length of "tulip" must equal 3
- The length of "tulip" must equal 3
[
    'length' => 'The length of "tulip" must equal 3',
]

Negative wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of "rose" must not equal 4
- The length of "rose" must not equal 4
[
    'length' => 'The length of "rose" must not equal 4',
]

Negative wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of "fern" must not equal 4
- The length of "fern" must not equal 4
[
    'length' => 'The length of "fern" must not equal 4',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
This is a template
- This is a template
[
    'length' => 'This is a template',
]

With wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The length of Cactus must equal 3
- The length of Cactus must equal 3
[
    'length' => 'The length of Cactus must equal 3',
]
