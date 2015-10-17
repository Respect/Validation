--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ObjectTypeException;

try {
    v::objectType()->check('');
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::objectType()->check(true);
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::objectType()->check(0);
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
"" must be of the type object
true must be of the type object
0 must be of the type object
