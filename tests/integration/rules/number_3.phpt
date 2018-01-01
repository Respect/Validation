--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::number()->assert(NAN);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- `NaN` must be a number
