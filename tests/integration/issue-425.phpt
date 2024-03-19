--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$validator = v::create()
    ->key('age', v::intType()->notEmpty()->noneOf(v::stringType(), v::arrayType()))
    ->key('reference', v::stringType()->notEmpty()->length(v::between(1, 50)));

exceptionFullMessage(static fn() => $validator->assert(['age' => 1]));
exceptionFullMessage(static fn() => $validator->assert(['reference' => 'QSF1234']));
?>
--EXPECT--
- reference must be present
- age must be present
