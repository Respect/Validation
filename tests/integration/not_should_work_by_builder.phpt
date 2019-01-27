--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
not() should work by builder
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::not(Validator::intVal())->validate(10));
?>
--EXPECT--
bool(false)
