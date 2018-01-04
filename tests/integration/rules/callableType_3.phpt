--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallableTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::callableType())->assert([]);
} catch (CallableTypeException $exception) {
    echo $exception->getFullMessage();
}

try {
    v::not(v::callableType())->assert('oneInexistentFunction');
} catch (CallableTypeException $exception) {
    echo $exception->getFullMessage();
}

try {
    v::not(v::callableType())->assert(100);
} catch (CallableTypeException $exception) {
    echo $exception->getFullMessage();
}

try {
    v::not(v::callableType())->assert(null);
} catch (CallableTypeException $exception) {
    echo $exception->getFullMessage();
}

try {
    v::not(v::callableType())->assert('');
} catch (CallableTypeException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--