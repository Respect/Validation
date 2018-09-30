--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FalseValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::falseVal()->check(true);
} catch (FalseValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::falseVal())->check('false');
} catch (FalseValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::falseVal()->assert(1);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::falseVal())->assert(0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
`TRUE` is not considered as "False"
"false" is considered as "False"
- 1 is not considered as "False"
- 0 is considered as "False"
