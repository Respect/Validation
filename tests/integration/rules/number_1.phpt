--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::number()->assertAll(13);
v::number()->assert(42);
?>
--EXPECTF--
