--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/805',
    static fn() => v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe'])
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/805
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
WRONG EMAIL!!!!!!
- WRONG EMAIL!!!!!!
[
    'email' => 'WRONG EMAIL!!!!!!',
]
