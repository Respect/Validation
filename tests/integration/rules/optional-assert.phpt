--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->assertAll('');
v::optional(v::alpha())->assertAll(null);
?>
===DONE===
--EXPECTF--
===DONE===
