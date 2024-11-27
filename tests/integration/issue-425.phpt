--FILE--
<?php

require 'vendor/autoload.php';

$validator = v::create()
    ->key('age', v::intType()->notEmpty()->noneOf(v::stringType(), v::arrayType()))
    ->key('reference', v::stringType()->notEmpty()->lengthBetween(1, 50));

exceptionFullMessage(static fn() => $validator->assert(['age' => 1]));
exceptionFullMessage(static fn() => $validator->assert(['reference' => 'QSF1234']));
?>
--EXPECT--
- reference must be present
- age must be present
