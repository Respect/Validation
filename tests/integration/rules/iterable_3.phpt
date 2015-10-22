--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IterableException;
use Respect\Validation\Validator as v;

try {
    v::not(v::iterable())->check([2, 3]);
} catch (IterableException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
{ 2, 3 } must not be iterable
