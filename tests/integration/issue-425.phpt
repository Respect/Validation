--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

$validator = v::create()
    ->key('age', v::intType()->notEmpty()->noneOf(v::stringType()))
    ->key('reference', v::stringType()->notEmpty()->length(1, 50));

try {
    $validator->assert(['age' => 1]);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

echo PHP_EOL;

try {
    $validator->assert(['reference' => 'QSF1234']);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- Key reference must be present
- Key age must be present
