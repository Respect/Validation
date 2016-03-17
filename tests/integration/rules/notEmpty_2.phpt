--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

try {
    v::notEmpty()->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notEmpty()->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
null must not be empty
- "" must not be empty
