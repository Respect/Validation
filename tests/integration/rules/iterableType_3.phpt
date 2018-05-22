--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IterableTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::iterableType())->check([2, 3]);
} catch (IterableTypeException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECTF--
`{ 2, 3 }` must not be iterable
