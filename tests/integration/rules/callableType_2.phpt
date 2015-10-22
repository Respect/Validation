--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallableTypeException;
use Respect\Validation\Validator as v;

try {
    v::callableType()->check([]);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->check('oneInexistentFunction');
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->check(100);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->check(null);
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::callableType()->check('');
} catch (CallableTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
{ } must be a callable
"oneInexistentFunction" must be a callable
100 must be a callable
null must be a callable
"" must be a callable