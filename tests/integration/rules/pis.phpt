--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PisException;
use Respect\Validation\Validator as v;

try {
    v::pis()->check('this thing');
} catch (PisException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::pis())->check('120.6671.406-4');
} catch (PisException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::pis()->assert('your mother');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::pis())->assert('120.9378.174-5');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"this thing" must be a valid PIS number
"120.6671.406-4" must not be a valid PIS number
- "your mother" must be a valid PIS number
- "120.9378.174-5" must not be a valid PIS number
