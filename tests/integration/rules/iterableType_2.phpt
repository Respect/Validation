--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IterableTypeException;
use Respect\Validation\Validator as v;

try {
    v::iterableType()->check(3);
} catch (IterableTypeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
3 must be iterable
