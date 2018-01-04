--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(
    v::alpha()->isValid(''),
    v::alpha()->isValid(null),
    v::optional(v::alpha())->isValid(''),
    v::optional(v::alpha())->isValid(null)
);
?>
--EXPECTF--
bool(false)
bool(false)
bool(true)
bool(true)
