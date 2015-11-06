--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::optional(v::alpha())->check('');
v::optional(v::alpha())->check(null);
?>
===DONE===
--EXPECTF--
===DONE===
