--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::digit()->assertAll(1);
v::digit()->assert(1);
?>
--EXPECTF--
