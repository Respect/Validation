--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::hetu(), '010106A901O'],
    'Inverted' => [v::not(v::hetu()), '010106A9012'],
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

Inverted
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
