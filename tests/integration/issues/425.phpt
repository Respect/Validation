--FILE--
<?php

require 'vendor/autoload.php';

$validator = v::create()
    ->key('age', v::intType()->notEmpty()->noneOf(v::stringType(), v::arrayType()))
    ->key('reference', v::stringType()->notEmpty()->lengthBetween(1, 50));

exceptionAll('https://github.com/Respect/Validation/issues/425', static fn() => $validator->assert(['age' => 1]));
exceptionAll('https://github.com/Respect/Validation/issues/425', static fn() => $validator->assert(['reference' => 'QSF1234']));
?>
--EXPECT--
https://github.com/Respect/Validation/issues/425
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
reference must be present
- reference must be present
[
    'reference' => 'reference must be present',
]

https://github.com/Respect/Validation/issues/425
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
age must be present
- age must be present
[
    'age' => 'age must be present',
]
