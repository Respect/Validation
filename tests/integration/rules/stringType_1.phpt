--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::stringType()->assert('hello world');
v::stringType()->check('welcome to PHP');
?>
--EXPECTF--
