--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::countable())->assert(new ArrayObject());
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- `[traversable] (ArrayObject: { })` must not be countable
