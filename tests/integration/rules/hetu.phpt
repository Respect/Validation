--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::hetu(), '010106A901O'],
    'Negative' => [v::not(v::hetu()), '010106A9012'],
    'With template' => [v::hetu(), '010106A901O', 'That is not a HETU'],
    'With name' => [v::hetu()->setName('Hetu'), '010106A901O'],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
"010106A901O" must be a valid Finnish personal identity code
- "010106A901O" must be a valid Finnish personal identity code
[
    'hetu' => '"010106A901O" must be a valid Finnish personal identity code',
]

Negative
⎺⎺⎺⎺⎺⎺⎺⎺
"010106A9012" must not be a valid Finnish personal identity code
- "010106A9012" must not be a valid Finnish personal identity code
[
    'notHetu' => '"010106A9012" must not be a valid Finnish personal identity code',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
That is not a HETU
- That is not a HETU
[
    'hetu' => 'That is not a HETU',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
Hetu must be a valid Finnish personal identity code
- Hetu must be a valid Finnish personal identity code
[
    'hetu' => 'Hetu must be a valid Finnish personal identity code',
]
