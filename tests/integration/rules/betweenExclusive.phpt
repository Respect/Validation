--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::betweenExclusive(1, 10), 12],
    'Negative' => [v::not(v::betweenExclusive(1, 10)), 5],
    'With template' => [v::betweenExclusive(1, 10), 12, 'Bewildered bees buzzed between blooming begonias'],
    'With name' => [v::betweenExclusive(1, 10)->setName('Range'), 10],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
12 must be greater than 1 and less than 10
- 12 must be greater than 1 and less than 10
[
    'betweenExclusive' => '12 must be greater than 1 and less than 10',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
5 must not be greater than 1 and less than 10
- 5 must not be greater than 1 and less than 10
[
    'betweenExclusive' => '5 must not be greater than 1 and less than 10',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Bewildered bees buzzed between blooming begonias
- Bewildered bees buzzed between blooming begonias
[
    'betweenExclusive' => 'Bewildered bees buzzed between blooming begonias',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
Range must be greater than 1 and less than 10
- Range must be greater than 1 and less than 10
[
    'Range' => 'Range must be greater than 1 and less than 10',
]

