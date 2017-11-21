--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::stringType()->assertAll('hello world');
v::stringType()->assert('welcome to PHP');
?>
--EXPECTF--
