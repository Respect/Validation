--TEST--
alwaysInvalid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator;

try {
    Validator::alwaysInvalid()->assertAll('');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- "" is always invalid
