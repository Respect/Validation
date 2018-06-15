--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\TypeException;
use Respect\Validation\Validator as v;

try {
    v::type('integer')->check('42');
} catch (TypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::type('string'))->check('foo');
} catch (TypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::type('double')->assert(20);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::type('bool'))->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"42" must be "integer"
"foo" must not be "string"
- 20 must be "double"
- `TRUE` must not be "bool"
