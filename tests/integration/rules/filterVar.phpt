--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FilterVarException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::filterVar(FILTER_VALIDATE_IP)->check(42);
} catch (FilterVarException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::filterVar(FILTER_VALIDATE_BOOLEAN))->check('On');
} catch (FilterVarException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
42 must be valid
"On" must not be valid
- 1.5 must be valid
- 1.0 must not be valid
