--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::notOptional()->check(0);
v::notOptional()->assert(false);
?>
===DONE===
--EXPECTF--
===DONE===
