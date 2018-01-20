--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::number()->assert(13);
v::number()->check(42);
?>
--EXPECTF--
