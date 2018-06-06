--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NegativeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::negative()->check(16);
} catch (NegativeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::negative())->check(-10);
} catch (NegativeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::negative()->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::negative())->assert('-144');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
16 must be negative
-10 must not be negative
- "a" must be negative
- "-144" must not be negative
