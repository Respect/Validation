--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::notOptional()->check(0);
v::notOptional()->assert(false);
v::notOptional()->assert([]);
v::notOptional()->check(true);
v::notOptional()->check(PHP_EOL);
?>
--EXPECTF--