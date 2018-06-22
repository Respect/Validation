--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\intValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::intVal()->check('42.33');
} catch (intValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::intVal())->check(2);
} catch (intValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::intVal()->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::intVal())->assert(3);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"42.33" must be an integer number
2 must not be an integer number
- "Foo" must be an integer number
- 3 must not be an integer number
