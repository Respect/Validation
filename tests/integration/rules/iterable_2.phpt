--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IterableException;
use Respect\Validation\Validator as v;

try {
    v::iterable()->check(3);
} catch (IterableException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
3 must be iterable
