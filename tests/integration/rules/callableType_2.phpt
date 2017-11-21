--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallableTypeException;
use Respect\Validation\Validator as v;

try {
    v::callableType()->assert([]);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->assert('oneInexistentFunction');
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->assert(100);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->assert(null);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->assert('');
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
`{ }` must be a callable
"oneInexistentFunction" must be a callable
100 must be a callable
`NULL` must be a callable
"" must be a callable
