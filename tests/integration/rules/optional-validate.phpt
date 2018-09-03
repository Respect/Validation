--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::alpha()->isValid(''));
var_dump(v::alpha()->isValid(null));

var_dump(v::optional(v::alpha())->isValid(''));
var_dump(v::optional(v::alpha())->isValid(null));
?>
--EXPECTF--
bool(false)
bool(false)
bool(true)
bool(true)
