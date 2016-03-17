--TEST--
PhpLabel rule exception should be thrown by assert() method
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::phpLabel()->assert('0wner');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::phpLabel())->assert('Respect');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
- "0wner" must be a valid PHP label
- "Respect" must not be a valid PHP label
