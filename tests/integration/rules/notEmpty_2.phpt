--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

try {
    v::notEmpty()->assert(null);
} catch (NotEmptyException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notEmpty()->assertAll('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
The value must not be empty
- The value must not be empty
