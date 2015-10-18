--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->assert('');
v::optional(v::alpha())->assert(null);
?>
===DONE===
--EXPECTF--
===DONE===
