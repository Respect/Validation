--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::alpha()->validate(''));
var_dump(v::alpha()->validate(null));

var_dump(v::optional(v::alpha())->validate(''));
var_dump(v::optional(v::alpha())->validate(null));
?>
--EXPECTF--
bool(false)
bool(false)
bool(true)
bool(true)
