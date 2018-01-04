--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ObjectTypeException;
use Respect\Validation\Validator as v;

try {
    v::objectType()->assert('');
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::objectType()->assert(true);
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::objectType()->assert(0);
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
"" must be an object
`TRUE` must be an object
0 must be an object
