--TEST--
PhpLabel rule exception should not be thrown for valid inputs
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::phpLabel()->check('topic01');
    v::phpLabel()->assert('access');
} catch (AllOfException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
