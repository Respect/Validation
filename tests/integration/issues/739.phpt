--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/739',
    static fn() => v::when(v::alwaysInvalid(), v::alwaysValid())->assert('foo')
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/739
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"foo" is invalid
- "foo" is invalid
[
    'alwaysInvalid' => '"foo" is invalid',
]
