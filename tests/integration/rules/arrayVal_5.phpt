--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::arrayVal())->assert(new ArrayObject([2, 3]));
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- `[traversable] (ArrayObject: { 2, 3 })` must not be an array
