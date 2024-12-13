--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/619',
    static fn() => v::instance(stdClass::class)->setTemplate('invalid object')->assert('test')
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/619
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
invalid object
- invalid object
[
    'instance' => 'invalid object',
]
