--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::notOptional()->assert(0);
v::notOptional()->assertAll(false);
v::notOptional()->assertAll([]);
v::notOptional()->assert(true);
v::notOptional()->assert(PHP_EOL);
?>
--EXPECTF--