--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FloatValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::floatVal()->check('a');
} catch (FloatValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::floatVal()->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::floatVal())->check(165.0);
} catch (FloatValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::floatVal())->assert('165.7');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"a" must be a float number
- "a" must be a float number
165.0 must not be a float number
- "165.7" must not be a float number
