--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotOptionalException;
use Respect\Validation\Validator as v;

try {
    v::notOptional()->assert(null);
} catch (NotOptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notOptional()->assertAll('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
The value must not be optional
- The value must not be optional
