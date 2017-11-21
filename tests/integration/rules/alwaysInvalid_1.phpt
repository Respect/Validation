--TEST--
alwaysInvalid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Validator;

try {
    Validator::alwaysInvalid()->assert('whatever');
} catch (AlwaysInvalidException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"whatever" is always invalid
